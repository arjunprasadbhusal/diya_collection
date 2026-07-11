<?php
putenv('APP_ENV=local');
$_SERVER['HTTP_HOST'] = 'localhost';
$_SERVER['SERVER_NAME'] = 'localhost';
$_SERVER['SERVER_PORT'] = '80';

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->singleton('request', function () {
    return Illuminate\Http\Request::capture();
});
$kernel = $app->make('Illuminate\Contracts\Http\Kernel');
$kernel->handle(Illuminate\Http\Request::capture());

echo 'Active Mailer: ' . config('mail.default') . PHP_EOL;
echo 'From Address: ' . config('mail.from.address') . PHP_EOL;
echo PHP_EOL;

try {
    \Illuminate\Support\Facades\Mail::raw('Test body', function ($msg) {
        $msg->to('diyacollection97@gmail.com')->subject('Test Subject');
    });
    echo 'MAIL SENT SUCCESSFULLY' . PHP_EOL;
} catch (\Throwable $e) {
    echo 'ERROR: ' . $e->getMessage() . PHP_EOL;
    echo 'File: ' . $e->getFile() . ':' . $e->getLine() . PHP_EOL;
}