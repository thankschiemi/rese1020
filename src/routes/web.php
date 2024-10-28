<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ReservationController;
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
Route::get('/done', [ReservationController::class, 'done']); // 予約完了ページ
