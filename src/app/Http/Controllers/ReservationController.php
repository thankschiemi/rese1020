<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreReservationRequest;
use App\Models\Reservation;
use App\Models\Restaurant;
use App\Models\Region;
use App\Models\Genre;
use App\Models\Favorite;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;


class ReservationController extends Controller
{
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

        // レストランの重複をIDベースで排除
        $restaurants = $query->select('id', 'name', 'region_id', 'genre_id', 'image_url')->distinct()->get();



        // ユーザーIDに基づいて各レストランがお気に入りかどうかを確認
        $user_id = 1; // 仮のユーザーIDを使用
        foreach ($restaurants as $restaurant) {
            $restaurant->is_favorite = Favorite::where('member_id', $user_id)->where('restaurant_id', $restaurant->id)->exists();
        }



        return view('restaurant_all', compact('restaurants', 'regions', 'genres'));
    }





    public function detail($shop_id)
    {
        $restaurant = Restaurant::with(['region', 'genre'])->findOrFail($shop_id);
        $user_id = 1; // 仮のユーザーIDを使用

        // 最新の予約情報を取得
        $latest_reservation = Reservation::where('member_id', $user_id)
            ->where('restaurant_id', $shop_id)
            ->latest()
            ->first();

        return view('restaurant_detail', compact('restaurant', 'latest_reservation'));
    }

    public function store(StoreReservationRequest $request)
    {
        $user_id = 1; // 仮のユーザーIDを使用

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


    public function done()
    {
        // リダイレクトされたときのデータを受け取る
        $restaurant_id = session('restaurant_id');

        // リダイレクト後に戻るためのリンクを設定
        return view('reservation_done', compact('restaurant_id'));
    }
}
