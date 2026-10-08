<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$tables = \Illuminate\Support\Facades\DB::select('SHOW TABLES');
echo "Tabel yang ada di database:\n";
foreach ($tables as $table) {
    $key = 'Tables_in_' . \Illuminate\Support\Facades\DB::connection()->getDatabaseName();
    echo "- " . $table->$key . "\n";
}
