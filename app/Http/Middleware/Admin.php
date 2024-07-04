<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //ika belum login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        //jika wd
        if (Auth::user()->nip != null) {
            return redirect()->route('wd.home');
        }

        //jika mahasiswa
        if (Auth::user()->nim != null) {
            return redirect()->route('mahasiswa.home');
        }

        //jika bukan wd / mahasiswa, biarin lanjut req
        return $next($request);
    }
}
