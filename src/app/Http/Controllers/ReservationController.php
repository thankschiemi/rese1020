<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Region;
use App\Models\Genre;

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



    public function detail()
    {
        return view('restaurant_detail');
    }

    public function done()
    {
        return view('reservation_done');
    }
}
