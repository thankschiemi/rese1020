<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('main_menu');
        }

        return back()->withErrors([
            'email' => 'メールアドレスまたはパスワードが一致しません。',
        ]);
    }

    public function register()
    {
        return view('auth.register');
    }

    public function store(RegisterRequest $request)
    {
        $data = $request->validated();

        $member = Member::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        // 自動ログイン
        Auth::login($member);

        // メール認証画面へリダイレクト
        return redirect()->route('verification.notice');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function accountSettings(Request $request)
    {
        // 直前のURLを取得
        $previousUrl = $request->headers->get('referer') ?? route('restaurants.index');

        return view(Auth::check() ? 'main_menu' : 'account_settings', [
            'user' => Auth::user(),
            'previousUrl' => $previousUrl,
        ]);
    }

    public function mainmenu(Request $request)
    {
        // ログイン状態の確認
        if (!Auth::check()) {
            // セッションにエラーメッセージを保存
            return redirect()->route('account-settings')->with('error', 'ログインが必要です。');
        }

        // 直前のURLを取得
        $previousUrl = $request->headers->get('referer') ?? route('restaurants.index');

        return view('main_menu', [
            'user' => Auth::user(),
            'previousUrl' => $previousUrl,
        ]);
    }





    public function thanks()
    {
        return view('thanks');
    }
}
