<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;

use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function store(Request $request, $restaurant_id)
    {
        $user_id = Auth::id();

        // お気に入りの確認と処理
        $favorite = Favorite::where('member_id', $user_id)
            ->where('restaurant_id', $restaurant_id)
            ->first();

        $isFavorite = false;

        if ($favorite) {
            $favorite->delete();
        } else {
            Favorite::create([
                'member_id' => $user_id,
                'restaurant_id' => $restaurant_id,
            ]);
            $isFavorite = true;
        }

        // JSONレスポンスを返す
        return response()->json(['isFavorite' => $isFavorite]);
    }



    public function __construct()
    {
        $this->middleware('auth'); // ログイン済みユーザーのみアクセス可能
    }
}
