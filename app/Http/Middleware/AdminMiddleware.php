<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class AdminMiddleware
 *
 * Middleware untuk memastikan hanya pengguna dengan role 'admin' yang dapat mengakses rute tertentu.
 *
 * @package App\Http\Middleware
 */
class AdminMiddleware
{
    /**
     * Menangani permintaan yang masuk.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah pengguna sudah login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Cek apakah pengguna memiliki role 'admin'
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action. Admin access required.');
        }

        // Lanjutkan permintaan
        return $next($request);
    }
}
