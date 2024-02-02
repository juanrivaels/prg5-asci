<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle($request, Closure $next, $role)
    {
        // Cek apakah pengguna telah login
        if (!Auth::check()) {
            return redirect(route('auth.login'))->with('error', 'Anda harus login terlebih dahulu.');
        }

        // Cek apakah pengguna memiliki role yang sesuai
        $user = Auth::user();
        if ($user->us_role != $role) {
            return redirect(route('dashboard.index'))->with('error', 'Anda tidak memiliki izin untuk mengakses halaman ini.');
        }

        return $next($request);
    }
}
