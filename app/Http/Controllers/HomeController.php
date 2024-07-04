<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(): View|RedirectResponse
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        } else if (Auth::user()->nim != null) {
            return view('mahasiswa.home');
        } else if (Auth::user()->nip != null) {
            return view('wd.home');
        } else {
            return view('admin.home');
        }
    }
}
