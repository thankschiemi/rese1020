<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

use SimpleSoftwareIO\QrCode\Facades\QrCode;

class MyPageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // 認証済みユーザーのみアクセス可能
    }

    public function index()
    {
        $user = Auth::user(); // ログイン中のユーザー情報を取得

        // 予約情報を取得し、QRコード用データを追加
        $reservations = Reservation::where('member_id', $user->id)
            ->with('restaurant')
            ->get()
            ->map(
                function ($reservation) {
                    // QRコードのデータを生成
                    $reservation->qrData = "予約情報:\n"
                        . "店舗名: {$reservation->restaurant->name}\n"
                        . "日時: {$reservation->reservation_date} {$reservation->reservation_time}\n"
                        . "人数: {$reservation->number_of_people}人";
                    return $reservation;
                }
            );






        // お気に入り情報を取得
        $favorites = Favorite::where('member_id', $user->id)->with('restaurant.region', 'restaurant.genre')->get();

        return view('my_page', compact('reservations', 'favorites', 'user'));
    }
}
