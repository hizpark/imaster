<?php

use App\Bootstrap\Env;

return [
    'name' => Env::get('APP_NAME', 'SlimForge'),
    'env' => Env::get('APP_ENV', 'production'),
    'debug' => Env::get('APP_DEBUG', false),
    'url' => Env::get('APP_URL', 'http://localhost'),
    'timezone' => Env::get('APP_TIMEZONE', 'UTC'),
];
