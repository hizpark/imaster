<?php

use App\Bootstrap\Env;

return [
    'driver' => Env::get('DB_DRIVER', 'mysql'),
    'host' => Env::get('DB_HOST', 'localhost'),
    'port' => Env::get('DB_PORT', 3306),
    'database' => Env::get('DB_DATABASE', 'imaster'),
    'username' => Env::get('DB_USERNAME', 'root'),
    'password' => Env::get('DB_PASSWORD', 'root'),
];
