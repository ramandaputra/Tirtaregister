<?php

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Support\Facades\DB;

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();
$v = DB::select('SHOW CREATE TABLE villages');
$r = DB::select('SHOW CREATE TABLE rayons');
echo json_encode(['villages' => $v, 'rayons' => $r], JSON_PRETTY_PRINT);
