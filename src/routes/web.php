<?php

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\MyPageController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OwnerController;
use App\Mail\NotificationMail;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\EmailController;


// ホームページ: 飲食店一覧
Route::get('/', [RestaurantController::class, 'index'])->name('restaurants.index');

// 飲食店の詳細ページ
Route::get('/detail/{shop_id}', [RestaurantController::class, 'detail'])
    ->middleware('auth') // authミドルウェアを適用
    ->name('restaurants.detail');


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

Route::get('/mypage', [MyPageController::class, 'index'])->middleware('auth')->name('mypage');


Route::get('/done', [ReservationController::class, 'done'])->name('reserve.done'); // 予約完了ページ


// 予約処理（新規作成）
Route::post('/reserve', [ReservationController::class, 'store'])->name('reserve.store');

// 予約削除処理
Route::delete('/reserve/{id}', [ReservationController::class, 'destroy'])->name('reserve.destroy');


// お気に入り登録
Route::post('/favorites/{restaurant_id}', [FavoriteController::class, 'store'])->name('favorites.store'); // お気に入り登録

// メール送信のルート
Route::get('/admin/emails/create', [\App\Http\Controllers\Admin\EmailController::class, 'create'])->name('admin.emails.create');
Route::post('/admin/emails/send', [\App\Http\Controllers\Admin\EmailController::class, 'send'])->name('admin.emails.send');

// 予約編集画面のルート
Route::get('/reservation/{id}/edit', [ReservationController::class, 'edit'])->name('reserve.edit');

//予約情報を更新するルート
Route::put('/reservation/{id}', [ReservationController::class, 'update'])->name('reserve.update');

//QRコード生成ルート
Route::get('/reservations/{id}/qr', [ReservationController::class, 'generateQR'])->name('reservations.qr');



//評価作成や編集に必要なルート
Route::get('/reviews/create/{reservation_id}', [ReviewController::class, 'create'])->name('reviews.create');
Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');


Route::get('/reviews/{review}/edit', [ReviewController::class, 'edit'])->name('reviews.edit');


// 管理者専用のルート
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.admin_home'); // 管理者ダッシュボード
    Route::get('/stores', [AdminController::class, 'manageStores'])->name('admin.stores.index'); // 店舗管理
    Route::get('/notifications', [AdminController::class, 'notifications'])->name('admin.notifications.index'); // 通知管理
    Route::post('/stores', [AdminController::class, 'store'])->name('admin.stores.store'); // 店舗代表者作成
});

// 店舗代表者専用のルート
Route::prefix('owner')->middleware(['auth', 'owner'])->group(function () {
    Route::get('/', [OwnerController::class, 'dashboard'])->name('owner.dashboard'); // 店舗代表者ダッシュボード
    Route::get('/stores/edit', [OwnerController::class, 'editStore'])->name('owner.stores.edit'); // 店舗情報編集
    Route::get('/reservations', [OwnerController::class, 'manageReservations'])->name('owner.reservations.index'); // 予約管理
    Route::post('/stores/update', [OwnerController::class, 'updateStore'])->name('owner.stores.update'); // 店舗情報更新
});

// 一般利用者のルート（既存機能に変更なし）
Route::middleware(['auth', 'user'])->group(function () {
    Route::get('/mypage', [MyPageController::class, 'index'])->name('mypage'); // マイページの表示
    Route::post('/reserve', [ReservationController::class, 'store'])->name('reserve.store'); // 予約作成
});
