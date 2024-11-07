<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Member;

class MemberController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function register()
    {
        return view('register');
    }

    public function store(Request $request)
    {
        // バリデーションを実行
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:members',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // ユーザーを作成
        $member = Member::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // メール認証リンクを送信
        $member->sendEmailVerificationNotification();

        // ログインページにリダイレクト
        return redirect()->route('login')->with('status', '登録が完了しました。メールを確認してください。');
    }

    public function accountSettings()
    {
        return view('account_settings');
    }

    public function mainmenu()
    {
        return view('main_menu');
    }
    public function thanks()
    {
        return view('thanks');
    }
}
