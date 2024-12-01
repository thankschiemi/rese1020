<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OwnerController extends Controller
{
    public function dashboard()
    {
        return view('owner.dashboard');
    }

    public function editStore()
    {
        // 店舗情報編集ページの表示
        return view('owner.edit_store');
    }

    public function manageReservations()
    {
        // 予約管理ページの表示
        return view('owner.manage_reservations');
    }

    public function updateStore(Request $request)
    {
        // 店舗情報の更新処理
        // 後で処理を実装する
        return redirect()->route('owner.dashboard')->with('success', '店舗情報を更新しました。');
    }
}
