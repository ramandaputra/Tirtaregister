<?php

use Illuminate\Support\Facades\Route;

// ============================================================
// CONTROLLERS
// ============================================================

// Public
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Public\ConnectionRequestController;

// Admin
use App\Http\Controllers\Admin\CustomerRequestController;

// Super Admin
use App\Http\Controllers\SuperAdmin\DashboardController;
use App\Http\Controllers\SuperAdmin\SettingController;
use App\Http\Controllers\SuperAdmin\NewsController as AdminNewsController;
use App\Http\Controllers\SuperAdmin\AdminManagementController;


/*
|--------------------------------------------------------------------------
| 1. ROUTE PUBLIK
|--------------------------------------------------------------------------
| Route yang dapat diakses tanpa login.
|--------------------------------------------------------------------------
*/

// Beranda
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Pendaftaran Pasang Baru
Route::get('/pasang-baru', [ConnectionRequestController::class, 'create'])
    ->name('public.register');

Route::post('/pasang-baru', [ConnectionRequestController::class, 'store'])
    ->name('public.register.store');

// Berita Publik
Route::get('/berita', [NewsController::class, 'index'])
    ->name('news.index');


/*
|--------------------------------------------------------------------------
| 2. ROUTE TERPROTEKSI
|--------------------------------------------------------------------------
| Route yang membutuhkan autentikasi dan email terverifikasi.
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard Umum
    |--------------------------------------------------------------------------
    */

Route::get('/dashboard', function () {
    return redirect()->route('superadmin.dashboard');
})->name('dashboard');


    /*
    |--------------------------------------------------------------------------
    | Profile
    |--------------------------------------------------------------------------
    */

    Route::controller(ProfileController::class)->group(function () {

        Route::get('/profile', 'edit')
            ->name('profile.edit');

        Route::patch('/profile', 'update')
            ->name('profile.update');

        Route::delete('/profile', 'destroy')
            ->name('profile.destroy');
    });


    /*
    |--------------------------------------------------------------------------
    | 3. SUPER ADMIN
    |--------------------------------------------------------------------------
    | Hanya dapat diakses oleh user dengan role super-admin.
    |--------------------------------------------------------------------------
    */

    Route::middleware(['role:super-admin'])
        ->prefix('superadmin')
        ->name('superadmin.')
        ->group(function () {

            // --------------------------------------------------------
            // Dashboard Super Admin
            // --------------------------------------------------------

            Route::get('/', function () {
                return redirect()->route('superadmin.dashboard');
            });

            Route::get('/dashboard', [DashboardController::class, 'index'])
                ->name('dashboard');


            // --------------------------------------------------------
            // Pengaturan Website
            // --------------------------------------------------------

            Route::get('/settings', [SettingController::class, 'index'])
                ->name('settings.index');

            Route::post('/settings', [SettingController::class, 'update'])
                ->name('settings.update');


            // --------------------------------------------------------
            // Manajemen Berita
            // --------------------------------------------------------

            Route::resource('news', AdminNewsController::class);


            // --------------------------------------------------------
            // Manajemen Admin
            // --------------------------------------------------------

            Route::resource('admins', AdminManagementController::class)
                ->except([
                    'show',
                    'edit',
                    'update',
                ]);
        });


    /*
    |--------------------------------------------------------------------------
    | 4. ADMIN & SUPER ADMIN
    |--------------------------------------------------------------------------
    | Route yang dapat digunakan oleh admin dan super-admin.
    |--------------------------------------------------------------------------
    */

    Route::middleware(['role:admin|super-admin'])
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {

            // Kelola Permintaan Pelanggan
            Route::resource(
                'requests',
                CustomerRequestController::class
            );
        });
});


/*
|--------------------------------------------------------------------------
| 5. ROUTE AUTENTIKASI
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';