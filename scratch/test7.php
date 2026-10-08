<?php

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Support\Facades\DB;

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

$kel = DB::select('SELECT * FROM kelurahan LIMIT 5');
print_r($kel);
$ray = DB::select('SELECT * FROM rayon LIMIT 5');
print_r($ray);
