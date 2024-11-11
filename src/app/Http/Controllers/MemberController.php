<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Member;

class MemberController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        // バリデーション
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // ログイン試行
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('main_menu');
        }

        return back()->withErrors([
            'email' => 'ログイン情報が一致しませんでした。',
        ]);
    }

    public function register()
    {
        return view('auth.register'); // 登録フォームのビュー
    }

    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:members',
            'password' => 'required|string|min:8',
        ]);

        // データ保存
        $member = Member::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // パスワードをハッシュ化
        ]);

        // メール認証リンクを送信
        $member->sendEmailVerificationNotification();

        return redirect()->route('verification.notice')->with('status', '登録が完了しました。メールを確認してください。');
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
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
