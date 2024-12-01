<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        // ユーザーがログインしており、かつ role が "admin" の場合のみ続行
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        // アクセス権がない場合は 403 エラーを返す
        abort(403, 'このページにはアクセスできません。');
    }
}
