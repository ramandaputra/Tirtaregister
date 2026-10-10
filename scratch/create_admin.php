<?php

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

// Create Role if not exists
$role = Role::firstOrCreate(['name' => 'admin_pelayanan']);

// Create User
$user = User::firstOrCreate(
    ['email' => 'pelayanan@tirtaregis.test'],
    [
        'name' => 'Admin Pelayanan',
        'password' => Hash::make('password123'),
    ]
);
$user->assignRole($role);

echo "Akun Admin Pelayanan berhasil dibuat:\n";
echo 'Email: '.$user->email."\n";
echo "Password: password123\n";
