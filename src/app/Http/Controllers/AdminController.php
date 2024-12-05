<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Notifications\AccountCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


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
        try {
            // 1. バリデーション
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:members,email',
                'password' => 'required|string|min:8',
            ]);

            // 2. 新規アカウント作成
            $user = Member::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => bcrypt($validated['password']),
                'role' => 'owner',
            ]);

            // メール送信
            $user->notify(new AccountCreated($request->password));

            // 3. 成功時のリダイレクト
            return redirect()->route('admin.users')->with('success', '店舗代表者を作成しました。登録したメールアドレス宛に通知を送信しましたので、ご確認ください。');
        } catch (\Exception $e) {
            // エラー発生時の処理
            return redirect()->back()->withErrors(['error' => 'ユーザー作成中にエラーが発生しました。']);
        }
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
