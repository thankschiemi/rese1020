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

        $favorite = Favorite::where('member_id', $user_id)
            ->where('restaurant_id', $restaurant_id)
            ->first();

        if ($favorite) {
            $favorite->delete();
        } else {
            Favorite::create([
                'member_id' => $user_id,
                'restaurant_id' => $restaurant_id,
            ]);
        }

        // リダイレクト時に特定のセクションに戻す
        return redirect()->back()->withFragment('favorite-section');

        return redirect()->back()->with('message', 'お気に入りを更新しました！')->withFragment('favorite-section');
    }


    public function __construct()
    {
        $this->middleware('auth'); // ログイン済みユーザーのみアクセス可能
    }
}
