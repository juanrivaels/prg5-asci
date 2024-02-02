<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 

class CheckGuestMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Periksa apakah pengguna telah login
        if (Auth::check()) {
            // Periksa apakah pengguna memiliki peran yang sesuai
            if ($request->user()->hasRole($role)) {
                return $next($request);
            }
        }

        // Jika belum login, redirect ke halaman login
        return redirect(route('auth.login'))->with('error', 'Silakan login terlebih dahulu.');
    }
}
