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

        // Mengambil berita terbaru untuk preview
        $latestNews = News::latest()->take(5)->get();

        return view('superadmin.dashboard', compact('totalNews', 'totalAdmins', 'totalSettings', 'latestNews'));
    }
}