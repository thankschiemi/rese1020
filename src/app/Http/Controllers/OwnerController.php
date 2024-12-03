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

        return redirect()->route('owner.edit_store')->with('success', '店舗情報を更新しました。');
    }
    public function manageReservations()
    {
        $reservations = Auth::user()->store->reservations; // 関連予約情報の取得
        return view('owner.manage_reservations', compact('reservations'));
    }
}
