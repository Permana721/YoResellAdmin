<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'Administrator') {
            return $next($request);
        }

        return redirect('/home'); // Mengarahkan pengguna non-admin ke halaman home
    }
}
