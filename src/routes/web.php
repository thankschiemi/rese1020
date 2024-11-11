<?php

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\MyPageController;
use App\Http\Controllers\HomeController;

// ホームページ
Route::get('/home', [HomeController::class, 'index'])->name('home');

// 認証関連のルート
Auth::routes();

// ユーザー関連のルート
Route::get('/login', [MemberController::class, 'login'])->name('login'); // ログインページ
Route::post('/login', [MemberController::class, 'authenticate'])->name('login.authenticate'); // ログイン処理
Route::get('/register', [MemberController::class, 'register'])->name('register'); // 登録フォーム表示
Route::post('/register', [MemberController::class, 'store'])->name('register.store'); // 登録処理

// メール認証関連
Route::get('/email/verify', function () {
    return view('auth.verify-email'); // メール確認ビュー
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/home'); // 認証後のリダイレクト先
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/resend', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.resend');

// アカウント設定・メインメニュー
Route::get('/account-settings', [MemberController::class, 'accountSettings'])->middleware('auth'); // アカウント設定
Route::get('/mainmenu', [MemberController::class, 'mainmenu'])->middleware('auth'); // メインメニュー

// サンクスページ
Route::get('/thanks', [MemberController::class, 'thanks']);

// マイページ関連
Route::get('/mypage', [MyPageController::class, 'index'])->middleware('auth'); // マイページ

// 飲食店関連のルート
Route::get('/', [ReservationController::class, 'index'])->name('restaurants.index'); // 飲食店一覧
Route::get('/detail/{shop_id}', [ReservationController::class, 'detail'])->name('restaurants.detail'); // 飲食店詳細
Route::get('/done', [ReservationController::class, 'done'])->name('reserve.done'); // 予約完了ページ
Route::post('/reserve', [ReservationController::class, 'store'])->name('reserve.store'); // 予約処理
Route::get('/reserve', [ReservationController::class, 'index'])->name('reserve.index'); // 予約一覧
Route::get('/restaurant/{restaurant_id}', [ReservationController::class, 'show'])->name('restaurants.show'); // 飲食店詳細表示

// お気に入り登録
Route::post('/favorites/{restaurant_id}', [FavoriteController::class, 'store'])->name('favorites.store'); // お気に入り登録
