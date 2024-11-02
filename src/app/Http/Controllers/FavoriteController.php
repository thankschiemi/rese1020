<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function store($restaurant_id)
    {
        $user_id = 1; // 仮のユーザーIDを指定

        // お気に入りの重複登録を防止
        if (!Favorite::where('member_id', $user_id)->where('restaurant_id', $restaurant_id)->exists()) {
            Favorite::create([
                'member_id' => $user_id,
                'restaurant_id' => $restaurant_id,
            ]);
        }

        return redirect()->back()->with('status', 'お気に入りに追加しました');
    }
}
