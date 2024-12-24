<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Notifications\AccountCreated;
use App\Http\Requests\AdminCreateMemberRequest;
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

    public function store(AdminCreateMemberRequest $request)
    {
        try {
            $validated = $request->validated();

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
        // リクエストの値を取得
        $role = $request->input('role');

        // 権限が正しい値かチェック
        if (!in_array($role, ['user', 'owner', 'admin'], true)) {
            return redirect()->route('admin.users')->withErrors(['role' => '無効な権限が指定されました。']);
        }

        $user = Member::findOrFail($id); // 指定したユーザーを取得

        $oldRole = $user->role; // 変更前の権限を記録
        $user->role = $request->role; // roleを更新
        $user->save(); // 保存

        $adminName = auth()->user()->name; // ログイン中の管理者の名前を取得
        $message = "{$adminName} がユーザー {$user->name} の権限を「{$oldRole}」から「{$role}」に更新しました。";

        return redirect()->route('admin.users')->with('success', $message);
    }
}
