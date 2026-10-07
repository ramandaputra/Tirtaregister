<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Mengambil data menggunakan fungsi helper
        $phone = setting('navbar_call_center', '0800-000-000');

        return view('home', compact('phone'));
    }

    public function updateSetting(Request $request)
    {
        // Menyimpan / meng-update data
        Setting::set('navbar_call_center', $request->input('call_center'), 'navbar');

        return back()->with('success', 'Pengaturan berhasil diperbarui!');
    }
}
