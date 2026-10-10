<?php

use App\Models\Rayon;
use Illuminate\Contracts\Console\Kernel;

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

$rayons = Rayon::all()->groupBy('kodearea')->map(function ($group) {
    return $group->map(function ($r) {
        return ['kode' => $r->koderayon, 'nama' => $r->namarayon];
    });
});
file_put_contents('scratch_rayons.json', json_encode($rayons, JSON_PRETTY_PRINT));
echo 'Done.';
