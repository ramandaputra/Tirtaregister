<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            [
                'key' => 'site_name',
                'value' => 'Silsilah Keluarga',
                'group' => 'general',
            ],
            [
                'key' => 'navbar_call_center',
                'value' => '+62 812-3456-7890',
                'group' => 'navbar',
            ],
            [
                'key' => 'footer_copyright',
                'value' => '© 2026 Hak Cipta Dilindungi.',
                'group' => 'footer',
            ],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
