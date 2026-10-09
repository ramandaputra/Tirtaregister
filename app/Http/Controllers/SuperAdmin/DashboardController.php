<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\User;
use App\Models\Setting;

class DashboardController extends Controller
{
    public function index()
    {
        // Menghitung statistik ringkas
        $totalNews = News::count();
        $totalAdmins = User::role('admin')->count();
        $totalSettings = Setting::count();

        // Statistik Pelanggan / Pendaftaran
        $totalPendaftaran = \App\Models\Pendaftaran::count();
        $totalPribadi = \App\Models\Pendaftaran::where('tipe', 'REGULER')->count();
        $totalFasilitasUmum = \App\Models\Pendaftaran::where('tipe', '!=', 'REGULER')->orWhereNull('tipe')->count();

        // Mengambil pendaftaran terbaru untuk preview (urutkan tanggal dan nomor registrasi untuk hari yang sama)
        $recentPendaftaran = \App\Models\Pendaftaran::orderBy('tgldaftar', 'desc')->orderBy('nomorreg', 'desc')->take(10)->get();

        // Mengambil berita terbaru untuk preview
        $latestNews = News::latest()->take(5)->get();

        // Mengambil log aktivitas terbaru untuk preview
        $latestLogs = \App\Models\ActivityLog::with('user')->latest()->take(10)->get();

        return view('superadmin.dashboard', compact(
            'totalNews', 'totalAdmins', 'totalSettings', 
            'totalPendaftaran', 'totalPribadi', 'totalFasilitasUmum',
            'recentPendaftaran', 'latestNews', 'latestLogs'
        ));
    }
}