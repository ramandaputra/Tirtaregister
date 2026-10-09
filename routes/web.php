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
use App\Http\Controllers\Admin\AdminPelangganController;

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
Route::get('/pasang-baru/rumah-tangga', [ConnectionRequestController::class, 'createRumahTangga'])
    ->name('public.register.rumah-tangga');

Route::get('/pasang-baru/fasilitas-umum', [ConnectionRequestController::class, 'createFasilitasUmum'])
    ->name('public.register.fasilitas-umum');

Route::get('/api/villages/{village}/rayons', [ConnectionRequestController::class, 'getRayons'])
    ->name('api.villages.rayons');

Route::get('/api/track', [ConnectionRequestController::class, 'trackStatus'])
    ->name('public.track');

Route::post('/pasang-baru', [ConnectionRequestController::class, 'store'])
    ->name('public.register.store');

Route::get('/pasang-baru/success/{regNumber}', [ConnectionRequestController::class, 'success'])
    ->name('public.register.success')
    ->where('regNumber', '.*');

// Berita Publik
Route::get('/berita', [NewsController::class, 'index'])
    ->name('news.index');
Route::get('/berita/{slug}', [NewsController::class, 'show'])
    ->name('news.show');


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
        if (auth()->user()->hasRole('superadmin')) {
            return redirect()->route('superadmin.dashboard');
        }
        if (auth()->user()->hasRole('admin')) {
            return redirect()->route('admin.pelanggan.dashboard');
        }
        return redirect('/');
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

    Route::middleware(['role:superadmin'])
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
            // Log Aktivitas
            // --------------------------------------------------------

            Route::get('/logs', [\App\Http\Controllers\SuperAdmin\ActivityLogController::class, 'index'])
                ->name('logs.index');

            // --------------------------------------------------------
            // Manajemen Berita
            // --------------------------------------------------------

            Route::resource('news', AdminNewsController::class);


            // --------------------------------------------------------
            // Manajemen Admin (SUDAH DIREVISI)
            // --------------------------------------------------------

            Route::resource('admins', AdminManagementController::class)
                ->except([
                    'show', // Hanya mengecualikan halaman 'show' (edit & update tetap diaktifkan)
                ]);
        });


    /*
    |--------------------------------------------------------------------------
    | 4. ADMIN & SUPER ADMIN
    |--------------------------------------------------------------------------
    | Route yang dapat digunakan oleh admin dan super-admin.
    |--------------------------------------------------------------------------
    */

    Route::middleware(['role:admin|superadmin'])
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {

            // Kelola Pelanggan (Admin Pelayanan)
            Route::get('/pelanggan/dashboard', [AdminPelangganController::class, 'dashboard'])->name('pelanggan.dashboard');
            Route::get('/pelanggan', [AdminPelangganController::class, 'index'])->name('pelanggan.index');
            Route::get('/pelanggan/prioritas', [AdminPelangganController::class, 'prioritas'])->name('pelanggan.prioritas');
            Route::get('/pelanggan/create', [AdminPelangganController::class, 'create'])->name('pelanggan.create');
            Route::post('/pelanggan', [AdminPelangganController::class, 'store'])->name('pelanggan.store');
            Route::get('/pelanggan/edit/{id}', [AdminPelangganController::class, 'edit'])->name('pelanggan.edit')->where('id', '.*');
            Route::put('/pelanggan/update/{id}', [AdminPelangganController::class, 'update'])->name('pelanggan.update')->where('id', '.*');
            Route::delete('/pelanggan/destroy/{id}', [AdminPelangganController::class, 'destroy'])->name('pelanggan.destroy')->where('id', '.*');
            Route::get('/pelanggan/print/{id}', [AdminPelangganController::class, 'print'])->name('pelanggan.print')->where('id', '.*');
            Route::get('/pelanggan/show/{id}', [AdminPelangganController::class, 'show'])->name('pelanggan.show')->where('id', '.*');

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