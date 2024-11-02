<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\MyPageController;

// ユーザー関連のルート
Route::get('/login', [MemberController::class, 'login'])->name('login'); // ログインページ
Route::get('/register', [MemberController::class, 'register']); // 会員登録ページ
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


// お気に入り登録関連のルート

Route::post('/favorites/{restaurant_id}', [FavoriteController::class, 'store'])->name('favorites.store');
