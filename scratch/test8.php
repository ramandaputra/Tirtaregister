<?php

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Support\Facades\DB;

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

$fks = DB::select("SELECT CONSTRAINT_NAME FROM information_schema.KEY_COLUMN_USAGE WHERE TABLE_NAME = 'connection_requests' AND TABLE_SCHEMA = 'tirtaregis' AND REFERENCED_TABLE_NAME IS NOT NULL");
foreach ($fks as $fk) {
    echo $fk->CONSTRAINT_NAME."\n";
}
