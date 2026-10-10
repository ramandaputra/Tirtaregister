<?php

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Support\Facades\DB;

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

$columns = DB::select('DESCRIBE pendaftaran');
echo "Struktur Tabel `pendaftaran`:\n";
foreach ($columns as $column) {
    echo "- {$column->Field} ({$column->Type})\n";
}
