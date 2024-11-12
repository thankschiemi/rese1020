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

class ReservationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // ログイン済みユーザーのみアクセス可能
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
}
