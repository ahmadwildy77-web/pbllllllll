<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureStudentIsAssessed
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'mahasiswa' && !Auth::user()->is_assessed) {
            return redirect()->route('asesmen_awal.create');
        }
        return $next($request);
    }
}
