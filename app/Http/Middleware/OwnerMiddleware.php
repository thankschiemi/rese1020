<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class OwnerMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'owner') {
            return $next($request);
        }

        return Auth::check() ? abort(403) : redirect('/account-settings');
    }
}
