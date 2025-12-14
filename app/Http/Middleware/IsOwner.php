<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth; // Jangan lupa import ini

class IsOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // CEK 1: Apakah user sudah login?
        // CEK 2: Apakah role-nya adalah 'owner'?
        if (Auth::check() && Auth::user()->role === 'owner') {
            // Jika YA, biarkan lanjut ke halaman tujuan
            return $next($request);
        }

        // Jika TIDAK, tendang keluar atau tampilkan error 403 (Forbidden)
        abort(403, 'Akses Ditolak. Halaman ini khusus Pemilik Kos.');
    }
}