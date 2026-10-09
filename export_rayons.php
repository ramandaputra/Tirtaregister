<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$rayons = \App\Models\Rayon::all()->groupBy('kodearea')->map(function($group) { 
    return $group->map(function($r) { 
        return ['kode' => $r->koderayon, 'nama' => $r->namarayon]; 
    }); 
});
file_put_contents('scratch_rayons.json', json_encode($rayons, JSON_PRETTY_PRINT));
echo "Done.";
