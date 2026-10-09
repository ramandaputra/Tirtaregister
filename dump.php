<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
$r = App\Models\Rayon::all();
$v = App\Models\Village::all();
file_put_contents('dump.json', json_encode(['r'=>$r,'v'=>$v], JSON_PRETTY_PRINT));
