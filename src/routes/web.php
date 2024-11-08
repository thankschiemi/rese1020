<?php

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\MyPageController;
use App\Http\Controllers\HomeController;

Route::get('/home', [HomeController::class, 'index'])->name('home');

Auth::routes();

// ユーザー関連のルート
Route::get('/login', [MemberController::class, 'login'])->name('login'); // ログインページ
Route::post('/login', [MemberController::class, 'authenticate'])->name('login.authenticate');

Route::get('/register', [MemberController::class, 'register'])->name('register'); // 会員登録ページ
Route::post('/register', [MemberController::class, 'store'])->name('register.store');



Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    // ホームページにリダイレクト
    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');



Route::get('/account-settings', [MemberController::class, 'accountSettings']); // アカウント設定ページ
Route::get('/mainmenu', [MemberController::class, 'mainmenu']); // メインメニュー
Route::get('/thanks', [MemberController::class, 'thanks']); // サンクスページ

// マイページ関連のルート
Route::get('/mypage', [MyPageController::class, 'index']); // マイページ



// 予約関連のルート
Route::get('/', [ReservationController::class, 'index'])->name('restaurants.index'); // 飲食店一覧ページ
Route::get('/detail/{shop_id}', [ReservationController::class, 'detail'])->name('restaurants.detail'); // 飲食店詳細ページ

Route::get('/done', [ReservationController::class, 'done'])->name('reserve.done');

Route::post('/reserve', [ReservationController::class, 'store'])->name('reserve.store');
Route::get('/reserve', [ReservationController::class, 'index'])->name('reserve.index');
Route::get('/restaurant/{restaurant_id}', [ReservationController::class, 'show'])->name('restaurants.show');

// お気に入り登録関連のルート

Route::post('/favorites/{restaurant_id}', [FavoriteController::class, 'store'])->name('favorites.store');
