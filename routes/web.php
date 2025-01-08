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
use App\Http\Controllers\PaymentController;

Route::get('/', [RestaurantController::class, 'index'])->name('restaurants.index');

Route::get('/detail/{shop_id}', [RestaurantController::class, 'detail'])
    ->middleware('auth')
    ->name('restaurants.detail');

Auth::routes(['verify' => true]);

Route::get('/login', [MemberController::class, 'login'])->name('login');
Route::post('/login', [MemberController::class, 'authenticate'])->name('login.authenticate');
Route::get('/register', [MemberController::class, 'register'])->name('register');
Route::post('/register', [MemberController::class, 'store'])->name('register.store');

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
    $user = Auth::user();
    return redirect('/main_menu');
})->middleware('auth')->name('auto-login');

Route::get('/home', function () {
    return Auth::check() ? redirect('/main_menu') : redirect('/account-settings');
})->name('home');

Route::get('/main_menu', [MemberController::class, 'mainmenu'])->middleware(['auth', 'verified']);

Route::get('/account-settings', [MemberController::class, 'accountSettings'])->name('account-settings');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/account-settings');
})->name('logout');

Route::get('/thanks', [MemberController::class, 'thanks'])->name('thanks');

Route::get('/mypage', [MyPageController::class, 'index'])->middleware('auth')->name('mypage');

Route::post('/reserve', [ReservationController::class, 'store'])->name('reserve.store');

Route::delete('/reserve/{id}', [ReservationController::class, 'destroy'])->name('reserve.destroy');

Route::post('/favorites/{restaurant_id}', [FavoriteController::class, 'store'])
    ->middleware('auth')
    ->name('favorites.store');

Route::get('/reservation/{id}/edit', [ReservationController::class, 'edit'])->name('reserve.edit');

Route::put('/reservation/{id}', [ReservationController::class, 'update'])->name('reserve.update');

Route::get('/reservations/{id}/qr', [ReservationController::class, 'generateQR'])->name('reservations.qr');

Route::get('/reviews/create/{reservation_id}', [ReviewController::class, 'create'])->name('reviews.create');
Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');

Route::get('/reviews/{review}/edit', [ReviewController::class, 'edit'])->name('reviews.edit');

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/stores', [AdminController::class, 'manageStores'])->name('admin.stores.index');
    Route::get('/notifications', [AdminController::class, 'notifications'])->name('admin.notifications.index');
    Route::post('/users', [AdminController::class, 'store'])->name('admin.users.store');
    Route::get('/users', [AdminController::class, 'manageUsers'])->name('admin.users');
    Route::put('/users/{id}/role', [AdminController::class, 'updateRole'])->name('admin.users.updateRole');
});

Route::prefix('owner')->middleware(['auth', 'owner'])->group(function () {
    Route::get('/dashboard', [OwnerController::class, 'dashboard'])->name('owner.dashboard');
    Route::get('/stores', [OwnerController::class, 'listStores'])->name('owner.store_list');
    Route::get('/stores/create', [OwnerController::class, 'createStore'])->name('owner.create_store');
    Route::post('/stores', [OwnerController::class, 'storeStore'])->name('owner.store');
    Route::get('/stores/edit/{id}', [OwnerController::class, 'editStore'])->name('owner.store_edit');
    Route::put('/stores/update/{id}', [OwnerController::class, 'updateStore'])->name('owner.update_store');
    Route::get('/reservations', [OwnerController::class, 'manageReservations'])->name('owner.reservations.index');
    Route::get('/campaign', [OwnerController::class, 'showCampaignForm'])->name('owner.campaign');
    Route::post('/campaign', [OwnerController::class, 'sendNotification'])->name('owner.sendNotification');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/mypage', [MyPageController::class, 'index'])->name('mypage');
    Route::post('/reserve', [ReservationController::class, 'store'])->name('reserve.store');
});

Route::get('/done', [ReservationController::class, 'done'])->name('reserve.done');

Route::get('/payment', [PaymentController::class, 'showPaymentPage'])->name('payment.page');
Route::post('/process-payment', [PaymentController::class, 'processPayment'])->name('payment.process');
Route::get('/payment-success', function () {
    return view('payment_success');
})->name('payment.success');
