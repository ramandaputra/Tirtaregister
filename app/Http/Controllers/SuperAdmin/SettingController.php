<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    // Tampilkan Form Edit Website di Dashboard Super Admin
    public function index()
    {
        // Mengambil semua setting dan dikelompokkan berdasarkan key
        $settings = Setting::pluck('value', 'key')->toArray();

        return view('superadmin.settings.index', compact('settings'));
    }

    // Simpan / Update Pengaturan Website
    public function update(Request $request)
    {
        $data = $request->except('_token');

        // Simpan input teks biasa
        foreach ($data as $key => $value) {
            if (! $request->hasFile($key) && $value !== null) {
                Setting::updateOrCreate(
                    ['key' => $key],
                    ['value' => $value]
                );
            }
        }

        // Simpan file gambar jika ada yang diupload
        foreach ($request->allFiles() as $key => $file) {
            $path = $file->store('settings', 'public');
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $path]
            );
        }

        return redirect()->back()->with('success', 'Pengaturan website berhasil diperbarui!');
    }
}
