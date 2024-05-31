<?php

use App\Http\Controllers\Mahasiswa;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\UserController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/mahasiswa',Mahasiswa::class);

Route::resource('/user',UserController::class);

Route::middleware('auth')->group(function(){
    Route::get('profil', [ProfilController::class, 'show'])->name('profil.show');
    Route::post('profil', [ProfilController::class, 'update'])->name('profil.edit');
});

