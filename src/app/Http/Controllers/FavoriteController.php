<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function store(Request $request, $restaurant_id)
    {
        $user_id = 1; // 現在のユーザーIDを仮に設定

        // 既にいいねされているかを確認
        $favorite = Favorite::where('member_id', $user_id)
            ->where('restaurant_id', $restaurant_id)
            ->first();

        if ($favorite) {
            // いいねを削除
            $favorite->delete();
        } else {
            // いいねを追加
            Favorite::create([
                'member_id' => $user_id,
                'restaurant_id' => $restaurant_id,
            ]);
        }

        // ページをリロードして「いいね」状態を反映
        return redirect()->back();
    }
}
