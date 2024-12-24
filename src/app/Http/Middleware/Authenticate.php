<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Closure;

class Authenticate extends Middleware
{
    /**
     * 未認証ユーザーがアクセスした場合のリダイレクト先を指定
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        // JSONリクエストでない場合に、未ログイン時のリダイレクト先を指定
        if (!$request->expectsJson()) {
            return route('account-settings'); // 未ログイン時はアカウント設定ページへ
        }
    }
}
