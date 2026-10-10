<?php

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Support\Facades\DB;

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

$k = DB::select('SHOW CREATE TABLE kelurahan');
$r = DB::select('SHOW CREATE TABLE rayon');

echo json_encode(['kelurahan' => $k, 'rayon' => $r], JSON_PRETTY_PRINT);
