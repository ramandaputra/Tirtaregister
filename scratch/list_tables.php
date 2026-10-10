<?php

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Support\Facades\DB;

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

$tables = DB::select('SHOW TABLES');
echo "Tabel yang ada di database:\n";
foreach ($tables as $table) {
    $key = 'Tables_in_'.DB::connection()->getDatabaseName();
    echo '- '.$table->$key."\n";
}
