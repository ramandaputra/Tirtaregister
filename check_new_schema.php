<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
$v = Illuminate\Support\Facades\DB::select('SHOW CREATE TABLE villages');
$r = Illuminate\Support\Facades\DB::select('SHOW CREATE TABLE rayons');
echo json_encode(['villages' => $v, 'rayons' => $r], JSON_PRETTY_PRINT);
