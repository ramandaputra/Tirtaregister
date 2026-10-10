<?php

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Support\Facades\DB;

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

$rayons = DB::select('SELECT * FROM rayons LIMIT 1');
$villages = DB::select('SELECT * FROM villages LIMIT 1');

echo json_encode(['rayons' => $rayons, 'villages' => $villages], JSON_PRETTY_PRINT);
