<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Reservation;
use App\Models\Region;
use App\Models\Genre;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class RestaurantController extends Controller
{
    public function index(Request $request)
    {
        $regions = Region::all();
        $genres = Genre::all();

        $query = Restaurant::query();

        // フィルタリング処理
        if ($request->filled('region_id')) {
            $query->where('region_id', $request->region_id);
        }
        if ($request->filled('genre_id')) {
            $query->where('genre_id', $request->genre_id);
        }
        if ($request->filled('keyword')) {
            $query->where('name', 'LIKE', "%{$request->keyword}%");
        }

        // 飲食店データを取得
        $restaurants = $query->select('id', 'name', 'region_id', 'genre_id', 'image_url')->distinct()->get();

        // 現在ログイン中のユーザーのお気に入り情報を付与
        $user_id = Auth::id();
        foreach ($restaurants as $restaurant) {
            $restaurant->is_favorite = Favorite::where('member_id', $user_id)->where('restaurant_id', $restaurant->id)->exists();
        }

        return view('restaurant_all', compact('restaurants', 'regions', 'genres'));
    }
    public function detail($shop_id)
    {
        $restaurant = Restaurant::with(['region', 'genre'])->findOrFail($shop_id);

        // ログイン中のユーザーの予約状況を取得
        $user_id = Auth::id();
        $latest_reservation = Reservation::where('member_id', $user_id)
            ->where('restaurant_id', $shop_id)
            ->latest()
            ->first();

        return view('restaurant_detail', compact('restaurant', 'latest_reservation'));
    }
}
