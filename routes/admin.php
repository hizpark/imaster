<?php

use App\Controllers\Backend\BackendController;
use Modules\User\Application\Controllers\UserController;

return [
    [
        'method' => 'GET',
        'path' => '[/]',
        'handler' => [BackendController::class, 'dashboard'],
    ],
    [
        'method' => 'GET',
        'path' => '/users',
        'handler' => [UserController::class, 'index'],
    ],
];
