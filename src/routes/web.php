<?php

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\MyPageController;
use App\Mail\NotificationMail;
use Illuminate\Support\Facades\Mail;


// ホームページ
Route::get('/', [ReservationController::class, 'index'])->name('restaurants.index'); // 飲食店一覧

// 認証関連のルート
Auth::routes(['verify' => true]);


// ユーザー関連のルート
Route::get('/login', [MemberController::class, 'login'])->name('login'); // ログインページ
Route::post('/login', [MemberController::class, 'authenticate'])->name('login.authenticate'); // ログイン処理
Route::get('/register', [MemberController::class, 'register'])->name('register'); // 登録フォーム表示
Route::post('/register', [MemberController::class, 'store'])->name('register.store'); // 登録処理

// メール認証関連
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/thanks');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/resend', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('resent', true);
})->middleware(['auth', 'throttle:6,1'])->name('verification.resend');



Route::post('/auto-login', function (Request $request) {
    $user = Auth::user(); // 現在ログイン中のユーザーを取得

    // ログイン状態を維持してメインメニューへ
    return redirect('/main_menu');
})->middleware('auth')->name('auto-login');

// ホーム画面（ログイン状態によってリダイレクト先を変更）
Route::get('/home', function () {
    return Auth::check() ? redirect('/main_menu') : redirect('/account-settings');
})->name('home');

// メインメニュー（ログイン状態専用 + メール認証必須）
Route::get('/main_menu', [MemberController::class, 'mainmenu'])->middleware(['auth', 'verified']);

// アカウント設定（未ログイン状態専用）
Route::get('/account-settings', [MemberController::class, 'accountSettings'])->name('account-settings');



// ログアウト処理
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/account-settings'); // ログアウト後に未ログイン用画面へ
})->name('logout');

// サンクスページ
Route::get('/thanks', [MemberController::class, 'thanks'])->name('thanks');

// マイページ関連
Route::get('/mypage', [MyPageController::class, 'index'])->middleware('auth'); // マイページ



// 飲食店関連のルート
Route::get('/detail/{shop_id}', [ReservationController::class, 'detail'])
    ->middleware('auth') // authミドルウェアを適用
    ->name('restaurants.detail');
Route::get('/done', [ReservationController::class, 'done'])->name('reserve.done'); // 予約完了ページ


// 予約処理（新規作成）
Route::post('/reserve', [ReservationController::class, 'store'])->name('reserve.store');

// 予約削除処理
Route::delete('/reserve/{id}', [ReservationController::class, 'destroy'])->name('reserve.destroy');


// お気に入り登録
Route::post('/favorites/{restaurant_id}', [FavoriteController::class, 'store'])->name('favorites.store'); // お気に入り登録


// テストメール
Route::get('/test-mail-simple', function () {
    Mail::raw('これはテストメールです。', function ($message) {
        $message->to('example@example.com')->subject('テストメール');
    });

    return 'テストメールを送信しました！';
});
