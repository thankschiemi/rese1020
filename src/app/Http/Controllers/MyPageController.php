<?php

namespace App\Http\Controllers;

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

        // ログイン中のユーザーが存在しない場合のフォールバック
        if (!$user) {
            return redirect()->route('account-settings');
        }

        // 予約情報を取得（リレーションを事前ロード）
        $reservations = Reservation::where('member_id', $user->id)
            ->with(['restaurant', 'restaurant.genre', 'restaurant.region']) // 必要なリレーションをすべてロード
            ->get()
            ->map(function ($reservation) {
                // モデル内のカスタムメソッドを使用してQRコードデータを生成
                $reservation->qrData = $reservation->generateQrData();
                return $reservation;
            });

        // お気に入り情報を取得
        $favorites = Favorite::where('member_id', $user->id)
            ->with(['restaurant.region', 'restaurant.genre']) // 必要なリレーションをロード
            ->get();

        // ビューにデータを渡してレンダリング
        return view('my_page', compact('reservations', 'favorites', 'user'));
    }
}
