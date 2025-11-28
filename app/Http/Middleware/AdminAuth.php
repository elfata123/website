<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * AdminAuth Middleware
 * 
 * Middleware untuk melindungi routes admin yang memerlukan login
 * Memeriksa apakah session admin_id sudah di-set
 * Jika belum login, redirect ke halaman login
 */
class AdminAuth
{
    /**
     * Handle request dan cek autentikasi admin
     * 
     * Proses:
     * 1. Periksa apakah session('admin_id') ada/tidak kosong
     * 2. Jika kosong: redirect ke /admin/login
     * 3. Jika ada: lanjutkan ke route yang diminta
     *
     * @param Request $request - HTTP request
     * @param Closure $next - Next middleware/controller
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah admin sudah login (session admin_id ada?)
        if (!session('admin_id')) {
            // Jika belum login, redirect ke halaman login
            return redirect('/admin/login');
        }

        // Jika sudah login, lanjutkan ke route yang diminta
        return $next($request);
    }
}
