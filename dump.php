<?php

use App\Models\Rayon;
use App\Models\Village;
use Illuminate\Contracts\Console\Kernel;

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();
$r = Rayon::all();
$v = Village::all();
file_put_contents('dump.json', json_encode(['r' => $r, 'v' => $v], JSON_PRETTY_PRINT));
