<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class OwnerMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'owner') {
            return $next($request); // オーナーの場合は次の処理に進む
        }

        // 認証済みの場合は403エラー、未認証の場合は/account-settingsにリダイレクト
        return Auth::check() ? abort(403) : redirect('/account-settings');
    }
}
