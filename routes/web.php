<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Public\ConnectionRequestController;
use App\Http\Controllers\Admin\CustomerRequestController;
use App\Http\Controllers\SuperAdmin\AdminManagementController;
use App\Http\Controllers\NewsController; // 1. Tambahkan import Controller Berita di sini

/*
|--------------------------------------------------------------------------
| 1. Rute Publik (Tanpa Login)
|--------------------------------------------------------------------------
*/
Route::get('/', function () { 
    return view('welcome'); 
});

// Form Pendaftaran Pasang Baru untuk Calon Pelanggan
Route::get('/pasang-baru', [ConnectionRequestController::class, 'create'])->name('public.register');
Route::post('/pasang-baru', [ConnectionRequestController::class, 'store'])->name('public.register.store');

// 2. Dipindahkan ke sini agar bebas diakses publik tanpa login:
Route::get('/berita', [NewsController::class, 'index'])->name('news.index');


/*
|--------------------------------------------------------------------------
| 2. Rute Terproteksi Login (Memerlukan Autentikasi)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard Bersama (Bisa diakses Admin & Super Admin)
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Route Profile (Bawaan Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // -------------------------------------------------------------
    // KHUSUS SUPER ADMIN (Membuat & Mengelola Akun Admin)
    // -------------------------------------------------------------
    Route::middleware(['role:super-admin'])
        ->prefix('superadmin')
        ->name('superadmin.')
        ->group(function () {
            Route::resource('admins', AdminManagementController::class);
        });

    // -------------------------------------------------------------
    // KHUSUS ADMIN & SUPER ADMIN (Mengelola Data Pelanggan)
    // -------------------------------------------------------------
    Route::middleware(['role:admin|super-admin'])
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {
            Route::resource('requests', CustomerRequestController::class);
        });

});

require __DIR__.'/auth.php';