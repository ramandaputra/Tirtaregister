<?php

use Illuminate\Contracts\Console\Kernel;

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();
echo now()->diffForHumans().PHP_EOL;
echo now()->translatedFormat('d F Y').PHP_EOL;
