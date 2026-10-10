<?php

use App\Models\ConnectionRequest;
use Illuminate\Contracts\Console\Kernel;

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

ConnectionRequest::where('registration_number', '0032/REG/1/X/2026')->update([
    'house_image_path' => 'house_images/xgfpWxEgTjvFXf8e1N3wOYyMy7PSTYgJ9RCSAxRN.jpg',
]);
echo 'Updated house image';
