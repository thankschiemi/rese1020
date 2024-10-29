<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreReservationRequest;
use App\Models\Reservation;
use App\Models\Restaurant;
use App\Models\Region;
use App\Models\Genre;
use Illuminate\Support\Facades\Session;

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

        $restaurants = $query->orderBy('id')->get();

        return view('restaurant_all', compact('restaurants', 'regions', 'genres'));
    }



    public function detail($shop_id)
    {
        $restaurant = Restaurant::with(['region', 'genre'])->findOrFail($shop_id);
        $reservation = Reservation::where('restaurant_id', $shop_id)->first();

        return view('restaurant_detail', compact('restaurant', 'reservation'));
    }



    public function store(StoreReservationRequest $request)
    {
        // 予約データの作成
        $reservation = Reservation::create([
            'member_id' => $request->member_id,
            'restaurant_id' => $request->restaurant_id,
            'reservation_date' => $request->date,
            'reservation_time' => $request->time,
            'number_of_people' => $request->number,
        ]);

        // 予約完了ページへのリダイレクト
        return redirect()->route('reserve.done');
    }


    public function done()
    {
        return view('reservation_done');
    }
}
