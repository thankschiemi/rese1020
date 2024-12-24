<?php

namespace App\Http\Controllers;


use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;


class FavoriteController extends Controller
{
    public function store($restaurant_id)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('account-settings');
        }

        // お気に入り登録または削除の処理
        $favorite = Favorite::where('member_id', $user->id)
            ->where('restaurant_id', $restaurant_id)
            ->first();

        if ($favorite) {
            $favorite->delete();
            return response()->json(['isFavorite' => false]);
        } else {
            Favorite::create([
                'member_id' => $user->id,
                'restaurant_id' => $restaurant_id,
            ]);
            return response()->json(['isFavorite' => true]);
        }
    }




    public function __construct()
    {
        $this->middleware('auth'); // ログイン済みユーザーのみアクセス可能
    }
}
