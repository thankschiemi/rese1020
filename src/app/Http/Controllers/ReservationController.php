<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreReservationRequest;
use App\Models\Reservation;
use App\Models\Restaurant;
use App\Models\Region;
use App\Models\Genre;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ReservationController extends Controller
{
    public function __construct()
    {
        // ログイン済みユーザーのみアクセス可能なメソッドを指定
        $this->middleware('auth')->except(['index', 'detail']);
    }


    public function index(Request $request)
    {
        $regions = Region::all();
        $genres = Genre::all();

        $query = Restaurant::query();

        if ($request->filled('region_id')) {
            $query->where('region_id', $request->region_id);
        }
        if ($request->filled('genre_id')) {
            $query->where('genre_id', $request->genre_id);
        }
        if ($request->filled('keyword')) {
            $query->where('name', 'LIKE', "%{$request->keyword}%");
        }

        $restaurants = $query->select('id', 'name', 'region_id', 'genre_id', 'image_url')->distinct()->get();

        // 現在のログインユーザーのID
        $user_id = Auth::id();

        // 各レストランがお気に入りかどうかを判定
        foreach ($restaurants as $restaurant) {
            $restaurant->is_favorite = Favorite::where('member_id', $user_id)->where('restaurant_id', $restaurant->id)->exists();
        }

        return view('restaurant_all', compact('restaurants', 'regions', 'genres'));
    }
    public function detail($shop_id)
    {
        $restaurant = Restaurant::with(['region', 'genre'])->findOrFail($shop_id);
        $user_id = Auth::id(); // ログイン中のユーザーIDを取得

        // 最新の予約情報を取得
        $latest_reservation = Reservation::where('member_id', $user_id)
            ->where('restaurant_id', $shop_id)
            ->latest()
            ->first();

        return view('restaurant_detail', compact('restaurant', 'latest_reservation'));
    }

    public function store(StoreReservationRequest $request)
    {
        $user_id = Auth::id(); // ログイン中のユーザーIDを取得

        // 予約情報をデータベースに保存
        $reservation = Reservation::create([
            'member_id' => $user_id,
            'restaurant_id' => $request->restaurant_id,
            'reservation_date' => $request->date,
            'reservation_time' => $request->time,
            'number_of_people' => $request->number,
        ]);

        // 予約完了画面にリダイレクト
        return redirect()->route('reserve.done')->with('restaurant_id', $request->restaurant_id);
    }
    public function destroy($id)
    {
        // 削除対象の予約を取得
        $reservation = Reservation::findOrFail($id);

        // ログインユーザーの予約かどうかを確認
        if ($reservation->member_id === Auth::id()) {
            $reservation->delete(); // 削除実行
            return redirect()->back()->with('message', '予約を削除しました。');
        }

        return redirect()->back()->with('error', 'この予約を削除する権限がありません。');
    }



    public function done()
    {
        // リダイレクトされたときのデータを受け取る
        $restaurant_id = session('restaurant_id');

        // リダイレクト後に戻るためのリンクを設定
        return view('reservation_done', compact('restaurant_id'));
    }

    public function edit($id)
    {
        // 指定された予約情報を取得
        $reservation = Reservation::findOrFail($id);

        // 編集画面を表示
        return view('reservations.edit', compact('reservation'));
    }
    public function update(Request $request, $id)
    {
        // 入力値のバリデーション
        $validated = $request->validate([
            'reservation_date' => 'required|date',
            'reservation_time' => 'required|date_format:H:i',
            'number_of_people' => 'required|integer|min:1',
        ]);

        // 予約情報の更新
        $reservation = Reservation::findOrFail($id);
        $reservation->update($validated);

        // マイページにリダイレクト
        return redirect()->route('mypage')->with('success', '予約情報が更新されました。');
    }
    public function generateQR($id)
    {
        $reservation = Reservation::findOrFail($id);
        $qrData = "予約情報: \n店舗: {$reservation->restaurant->name}\n日時: {$reservation->reservation_date} {$reservation->reservation_time}\n人数: {$reservation->number_of_people}人";

        return response(
            QrCode::encoding('UTF-8') // エンコーディングを UTF-8 に設定
                ->size(200)
                ->generate($qrData)
        )->header('Content-Type', 'image/svg+xml');
    }
}
