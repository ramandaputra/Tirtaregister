<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$k = Illuminate\Support\Facades\DB::select('SHOW CREATE TABLE kelurahan');
$r = Illuminate\Support\Facades\DB::select('SHOW CREATE TABLE rayon');

echo json_encode(['kelurahan' => $k, 'rayon' => $r], JSON_PRETTY_PRINT);
