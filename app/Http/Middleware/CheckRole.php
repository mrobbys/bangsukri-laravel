<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Cek apakah pengguna sudah login DAN rolenya TIDAK SESUAI dengan yang dibutuhkan.
        //    Auth::user()->role akan mengambil nilai dari kolom 'role' di tabel users.
        if (!Auth::check() || Auth::user()->role !== $role) {

            // Jika tidak sesuai, arahkan (redirect) berdasarkan role mereka saat ini.
            if (Auth::user()->role === 'admin') {
                // Jika dia adalah admin (tapi mencoba akses halaman user),
                // arahkan ke dashboard admin.
                return redirect()->route('admin.index');
            } else {
                // Jika dia adalah user (tapi mencoba akses halaman admin),
                // arahkan ke halaman utama (homepage).
                return redirect('/');
            }
        }

        // 3. Jika role-nya sesuai, izinkan untuk melanjutkan ke halaman tujuan.
        return $next($request);
    }
}
