<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class MyPageController extends Controller
{
    public function index()
    {
        $user_id = 1;


        // ユーザーの予約情報を取得
        $reservations = Reservation::where('member_id', $user_id)->with('restaurant')->get();


        // ユーザーのお気に入り店舗を取得
        $favorites = Favorite::where('member_id', $user_id)->with('restaurant.region', 'restaurant.genre')->get();


        return view('my_page', compact('reservations', 'favorites'));
    }
}
