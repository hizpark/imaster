<?php

use App\Bootstrap\Env;

return [
    'default_locale' => Env::get('WEB_DEFAULT_LOCALE', 'en'),
];
