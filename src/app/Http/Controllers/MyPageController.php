<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class MyPageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // 認証済みユーザーのみアクセス可能
    }

    public function index()
    {
        $user = Auth::user(); // ログイン中のユーザー情報を取得
        $reservations = Reservation::where('member_id', $user->id)->with('restaurant')->get();
        $favorites = Favorite::where('member_id', $user->id)->with('restaurant.region', 'restaurant.genre')->get();

        return view('my_page', compact('reservations', 'favorites', 'user'));
    }
}
