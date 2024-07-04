<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KritiksaranController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WDController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landingpage');
});

//Admin
Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/home', [HomeController::class, 'index'])->name('admin.home');
        Route::get('/admins', [AdminController::class, 'index'])->name('admin.admins.index');
        Route::get('/admins/create', [AdminController::class, 'create'])->name('admin.admins.create');
        Route::post('/admins', [AdminController::class, 'store'])->name('admin.admins.store');
        Route::get('/admins/edit/{id}', [AdminController::class, 'edit'])->name('admin.admins.edit');
        Route::put('/admins/update/{id}', [AdminController::class, 'update'])->name('admin.admins.update');
        Route::delete('/admins/{id}', [AdminController::class, 'destroy'])->name('admin.admins.destroy');

        Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('admin.mahasiswa.index');
        Route::get('/mahasiswa/create', [MahasiswaController::class, 'create'])->name('admin.mahasiswa.create');
        Route::post('/mahasiswa', [MahasiswaController::class, 'store'])->name('admin.mahasiswa.store');
        Route::get('/mahasiswa/edit/{nim}', [MahasiswaController::class, 'edit'])->name('admin.mahasiswa.edit');
        Route::put('/mahasiswa/update/{nim}', [MahasiswaController::class, 'update'])->name('admin.mahasiswa.update');
        Route::delete('/mahasiswa/{nim}', [MahasiswaController::class, 'destroy'])->name('admin.mahasiswa.destroy');

        Route::get('/wd', [WDController::class, 'index'])->name('admin.wd.index');
        Route::get('/wd/create', [WDController::class, 'create'])->name('admin.wd.create');
        Route::post('/wd', [WDController::class, 'store'])->name('admin.wd.store');
        Route::get('/wd/edit/{nip}', [WDController::class, 'edit'])->name('admin.wd.edit');
        Route::put('/wd/update/{nip}', [WDController::class, 'update'])->name('admin.wd.update');
        Route::delete('/wd/{nip}', [WDController::class, 'destroy'])->name('admin.wd.destroy');

        Route::get('/user', [UserController::class, 'index'])->name('admin.user.index');
        Route::get('/user/create', [UserController::class, 'create'])->name('admin.user.create');
        Route::post('/user', [UserController::class, 'store'])->name('admin.user.store');
        Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('admin.user.edit');
        Route::put('/user/update/{id}', [UserController::class, 'update'])->name('admin.user.update');
        Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('admin.user.destroy');

        Route::get('/kritiksaran', [KritiksaranController::class, 'index'])->name('admin.kritiksarans');
        Route::get('/pengaduan', [PengaduanController::class, 'index'])->name('admin.pengaduans');
        Route::delete('/pengaduan/{id}', [PengaduanController::class, 'destroy'])->name('admin.pengaduans.destroy');
    });
});



//WD
Route::middleware(['auth', 'verified', 'wd'])->group(function () {
    Route::prefix('wd')->group(function () {
        Route::get('/home', [HomeController::class, 'index'])->name('wd.home');

        Route::get('/kritiksarans', [KritiksaranController::class, 'index'])->name('wd.kritiksarans');

        Route::get('/pengaduans', [PengaduanController::class, 'index'])->name('wd.pengaduans');
        Route::put('/pengaduans/update/{id}', [PengaduanController::class, 'update'])->name('wd.pengaduans.update');
        Route::delete('/pengaduans/{id}', [PengaduanController::class, 'destroy'])->name('wd.pengaduans.destroy');

        Route::get('/cetakKritikSaran', [KritiksaranController::class, 'cetak'])->name('wd.cetakKritikSaran');

    });
});

// Mahasiswa
Route::middleware(['auth', 'verified', 'mahasiswa'])->group(function () {

    Route::get('/home', [HomeController::class, 'index'])->name('mahasiswa.home');

    Route::get('/pengaduans', [PengaduanController::class, 'index'])->name('mahasiswa.pengaduans.index');
    Route::get('/pengaduans/create', [PengaduanController::class, 'create'])->name('mahasiswa.pengaduans.create');
    Route::post('/pengaduans', [PengaduanController::class, 'store'])->name('mahasiswa.pengaduans.store');
    Route::get('/pengaduans/edit/{id}', [PengaduanController::class, 'edit'])->name('mahasiswa.pengaduans.edit');
    Route::put('/pengaduans/update/{id}', [PengaduanController::class, 'update'])->name('mahasiswa.pengaduans.update');
    Route::delete('/pengaduans/{id}', [PengaduanController::class, 'destroy'])->name('mahasiswa.pengaduans.destroy');

    Route::get('/kritiksarans', [KritiksaranController::class, 'index'])->name('mahasiswa.kritiksarans.index');
    Route::get('/kritiksarans/create', [KritiksaranController::class, 'create'])->name('mahasiswa.kritiksarans.create');
    Route::post('/kritiksarans', [KritiksaranController::class, 'store'])->name('mahasiswa.kritiksarans.store');
    Route::get('/kritiksarans/edit/{id}', [KritiksaranController::class, 'edit'])->name('mahasiswa.kritiksarans.edit');
    Route::put('/kritiksarans/update/{id}', [KritiksaranController::class, 'update'])->name('mahasiswa.kritiksarans.update');
    Route::delete('/kritiksarans/delete/{id}', [KritiksaranController::class, 'destroy'])->name('mahasiswa.kritiksarans.destroy');


});

Route::middleware('auth')->group(function () {
Route::get('/profil', [ProfileController::class, 'index'])->name('profil.index');
Route::get('/profil/edit', [ProfileController::class, 'edit'])->name('profil.edit');
Route::put('/profil', [ProfileController::class, 'update'])->name('profil.update');
    Route::put('/password', [ProfileController::class, 'updatePassword'])->name('password.update');
});

// Authentication Routes
require __DIR__ . '/auth.php';
