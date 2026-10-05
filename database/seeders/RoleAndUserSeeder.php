<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class RoleAndUserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Role
        $superAdminRole = Role::create(['name' => 'super-admin']);
        $adminRole      = Role::create(['name' => 'admin']);

        // 2. Buat Akun Super Admin Utama
        $superAdmin = User::create([
            'name'     => 'PUSINPEL',
            'email'    => 'pusinpel@tirtakepri.co.id',
            'password' => Hash::make('password123'), // Ubah password saat produksi
        ]);

        // 3. Assign Role super-admin ke akun tersebut
        $superAdmin->assignRole($superAdminRole);
    }
}