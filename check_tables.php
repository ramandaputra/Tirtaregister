<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$rayons = Illuminate\Support\Facades\DB::select('SELECT * FROM rayons LIMIT 1');
$villages = Illuminate\Support\Facades\DB::select('SELECT * FROM villages LIMIT 1');

echo json_encode(['rayons' => $rayons, 'villages' => $villages], JSON_PRETTY_PRINT);
