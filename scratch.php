<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$villages = App\Models\Village::take(5)->get();
$rayons = App\Models\Rayon::take(5)->get();

echo json_encode(['v' => $villages, 'r' => $rayons], JSON_PRETTY_PRINT);
