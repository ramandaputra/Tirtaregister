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

        // Handle dynamic branch contacts
        if ($request->has('branch_contacts')) {
            $contacts = $request->input('branch_contacts');
            $cleaned = [];
            if (is_array($contacts)) {
                // Ensure strictly sequential order matching index 0, 1, 2...
                ksort($contacts, SORT_NUMERIC);
                foreach ($contacts as $item) {
                    if (is_array($item)) {
                        $branch = trim($item['branch'] ?? '');
                        $name = trim($item['name'] ?? '');
                        $wa = trim($item['wa'] ?? '');
                        if ($branch !== '' || $wa !== '') {
                            $cleaned[] = [
                                'branch' => $branch,
                                'name' => $name,
                                'wa' => $wa,
                            ];
                        }
                    }
                }
            }

            $cleaned = array_values($cleaned);

            Setting::updateOrCreate(
                ['key' => 'branch_contacts'],
                ['value' => json_encode($cleaned)]
            );

            // Sync legacy branch keys for backwards compatibility in exact order
            if (isset($cleaned[0])) {
                Setting::updateOrCreate(['key' => 'branch_1_name'], ['value' => $cleaned[0]['branch']]);
                Setting::updateOrCreate(['key' => 'branch_1_wa'], ['value' => $cleaned[0]['wa']]);
            }
            if (isset($cleaned[1])) {
                Setting::updateOrCreate(['key' => 'branch_2_name'], ['value' => $cleaned[1]['branch']]);
                Setting::updateOrCreate(['key' => 'branch_2_wa'], ['value' => $cleaned[1]['wa']]);
            }
            if (isset($cleaned[2])) {
                Setting::updateOrCreate(['key' => 'branch_3_name'], ['value' => $cleaned[2]['branch']]);
                Setting::updateOrCreate(['key' => 'branch_3_wa'], ['value' => $cleaned[2]['wa']]);
            }

            unset($data['branch_contacts']);
        }

        // Simpan input teks biasa
        foreach ($data as $key => $value) {
            if (! $request->hasFile($key) && $value !== null) {
                $saveValue = is_array($value) ? json_encode($value) : $value;
                Setting::updateOrCreate(
                    ['key' => $key],
                    ['value' => $saveValue]
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
