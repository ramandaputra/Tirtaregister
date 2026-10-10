<?php

use App\Models\Rayon;
use App\Models\Village;
use Illuminate\Contracts\Console\Kernel;

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

$villages = Village::take(5)->get();
$rayons = Rayon::take(5)->get();

echo json_encode(['v' => $villages, 'r' => $rayons], JSON_PRETTY_PRINT);
