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
        $store = Auth::user()->store; // ログイン中ユーザーの店舗情報を取得

        if (!$store) {
            $store = null; // 新規作成の場合
        }

        $regions = Region::all();
        $genres = Genre::all();

        return view('owner.edit_store', compact('store', 'regions', 'genres'));
    }

    public function storeStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'region_id' => 'required|exists:regions,id',
            'genre_id' => 'required|exists:genres,id',
            'description' => 'nullable|string',
            'image_url' => 'nullable|url',
        ]);

        $store = new Restaurant();
        $store->fill($request->all());
        $store->member_id = Auth::id(); // ログイン中のユーザーを関連付け
        $store->save();

        return redirect()->route('owner.store_edit')->with('success', '店舗情報を作成しました！');
    }

    public function updateStore(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'region_id' => 'required|exists:regions,id',
            'genre_id' => 'required|exists:genres,id',
            'description' => 'nullable|string',
            'image_url' => 'nullable|url',
        ]);

        $store = Restaurant::findOrFail($id);
        $store->update($request->all());

        return redirect()->route('owner.store_edit')->with('success', '店舗情報を更新しました！');
    }
    public function manageReservations()
    {
        $reservations = Auth::user()->store->reservations; // 関連予約情報の取得
        return view('owner.manage_reservations', compact('reservations'));
    }
}
