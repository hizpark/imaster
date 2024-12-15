<?php

use App\Bootstrap\Env;

return [
    'name' => Env::get('APP_NAME', 'app'),
    'path' => __DIR__ . '/../storage/logs/app.log',
];
