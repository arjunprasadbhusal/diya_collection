<?php

use Illuminate\Support\Facades\Mail;

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    Mail::raw('Test email from Diya Collection - SMTP is working!', function ($msg) {
        $msg->to('diyacollection97@gmail.com')->subject('Test Email from Diya Collection');
    });
    echo "Test email sent successfully!\n";
} catch (\Throwable $e) {
    echo 'Error: ' . $e->getMessage() . "\n";
}
