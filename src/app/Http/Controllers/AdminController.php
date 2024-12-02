<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.admin_home');
    }

    public function manageStores()
    {
        // 店舗管理画面
        return view('admin.stores');
    }

    public function notifications()
    {
        // 通知管理画面
        return view('admin.notifications');
    }

    public function store(Request $request)
    {
        // 店舗代表者作成処理
        // 仮に何か処理を行う場合
        return redirect()->route('admin.stores.index')->with('status', '店舗代表者が作成されました。');
    }
}
