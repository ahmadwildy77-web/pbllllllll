<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check() || !in_array(Auth::user()->role, $roles)) {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        if (Auth::user()->status_akun === 'Non-Aktif') {
            Auth::logout();
            return redirect('/login')->withErrors(['email' => 'Akun Anda Non-Aktif.']);
        }

        return $next($request);
    }
}
