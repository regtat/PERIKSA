<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Mahasiswa
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // jika user blm login
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        if (Auth::user()->nim != null) {
            return $next($request);
        }
        if (Auth::user()->nip != null) {
            return redirect()->route('wd.home');
        }
        return redirect()->route('admin.home');
    }
}

