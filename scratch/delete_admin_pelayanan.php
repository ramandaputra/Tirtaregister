<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use Spatie\Permission\Models\Role;

// Assign admin role to the user
$user = User::where('email', 'pelayanan@tirtaregis.test')->first();
if ($user) {
    $user->syncRoles(['admin']);
    echo "User changed to admin role.\n";
}

// Delete admin_pelayanan role
$role = Role::where('name', 'admin_pelayanan')->first();
if ($role) {
    $role->delete();
    echo "Role admin_pelayanan deleted.\n";
} else {
    echo "Role admin_pelayanan not found.\n";
}
