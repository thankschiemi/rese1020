<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Restaurant;
use App\Models\Region;
use App\Models\Genre;


class OwnerController extends Controller
{
    public function dashboard()
    {
        return view('owner.owner_home');
    }

    public function editStore()
    {
        $store = Auth::user()->store;

        if (!$store) {
            return redirect()->back()->with('error', '店舗情報が見つかりません。');
        }

        $regions = Region::all(); // 地域データ
        $genres = Genre::all(); // ジャンルデータ

        return view('owner.edit_store', compact('store', 'regions', 'genres'));
    }

    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'name' => 'required|string|max:255',
            'region_id' => 'required|exists:regions,id',
            'genre_id' => 'required|exists:genres,id',
            'description' => 'nullable|string',
            'image_url' => 'nullable|url',
        ]);

        // 新しい店舗情報を作成
        Restaurant::create([
            'name' => $request->name,
            'region_id' => $request->region_id,
            'genre_id' => $request->genre_id,
            'description' => $request->description,
            'image_url' => $request->image_url,
            'member_id' => Auth::id(), // ログイン中の店舗代表者のIDをセット
        ]);

        // 作成完了後のリダイレクト
        return redirect()->route('owner.edit_store')->with(['success' => '店舗情報を作成しました！']);
    }
    public function manageReservations()
    {
        $reservations = Auth::user()->store->reservations; // 関連予約情報の取得
        return view('owner.manage_reservations', compact('reservations'));
    }
}
