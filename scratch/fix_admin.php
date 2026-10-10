<?php

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Role;

$role = Role::firstOrCreate(['name' => 'admin_pelayanan']);

$user = User::firstOrNew(['email' => 'pelayanan@tirtaregis.test']);
$user->name = 'Admin Pelayanan';
$user->password = Hash::make('password123');
$user->email_verified_at = now();
if (Schema::hasColumn('users', 'status')) {
    $user->status = 'active';
}
$user->save();

$user->assignRole($role);

echo "Akun Admin Pelayanan diperbarui:\n";
echo 'Email: '.$user->email."\n";
echo "Password: password123\n";
echo 'Role: '.$user->roles->pluck('name')->implode(', ')."\n";
echo 'Email Verified: '.($user->email_verified_at ? 'Yes' : 'No')."\n";
