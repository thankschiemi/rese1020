<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;

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

    public function manageUsers()
    {
        $users = Member::all(); // 全ユーザーを取得
        return view('admin.users', compact('users'));
    }

    // 権限を更新
    public function updateRole(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|in:user,owner,admin', // roleのバリデーション
        ]);

        $user = Member::findOrFail($id); // 指定したユーザーを取得
        $user->role = $request->role; // roleを更新
        $user->save(); // 保存

        return redirect()->route('admin.users')->with('success', '権限を更新しました。');
    }
}
