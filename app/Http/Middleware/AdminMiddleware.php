<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Melindungi semua route /admin/*.
 * Jika URL admin diketik langsung di address bar tanpa login,
 * atau login sebagai "user" biasa, maka akan ditolak / diarahkan ke login.
 */
class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Belum login sama sekali -> lempar ke halaman login
        if (! auth()->check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Sudah login tapi bukan admin -> tidak boleh tembus ke panel admin
        if (auth()->user()->role !== 'admin') {
            auth()->logout();
            return redirect()->route('login')->with('error', 'Akun Anda tidak memiliki akses ke halaman Admin.');
        }

        return $next($request);
    }
}
