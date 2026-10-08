<?php

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Support\Facades\DB;

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

$tables = ['pekerjaan', 'sumberair', 'jenisbangunanpribadi', 'jenisbangunanfasum', 'kepemilikan', 'kepemilikanfasum', 'peruntukan', 'kelurahan', 'rayon'];
foreach ($tables as $t) {
    try {
        $cols = DB::select("DESCRIBE $t");
        echo "Table: $t\n";
        foreach ($cols as $c) {
            echo "  - {$c->Field}\n";
        }
    } catch (Exception $e) {
    }
}
