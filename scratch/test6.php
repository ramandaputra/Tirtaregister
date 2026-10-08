<?php

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Support\Facades\DB;

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

try {
    $cols = DB::select('DESCRIBE water_sources');
    echo "water_sources cols:\n";
    foreach ($cols as $c) {
        echo $c->Field."\n";
    }

    $rows = DB::select('SELECT * FROM water_sources LIMIT 5');
    echo "water_sources rows:\n";
    print_r($rows);
} catch (Exception $e) {
    echo $e->getMessage();
}
