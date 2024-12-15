<?php

use App\Controllers\Frontend\FrontendController;

return [
    [
        'method' => 'GET',
        'path' => '/[{lang}[/{path:.*}]]',
        'handler' => [FrontendController::class, 'dispatch'],
    ]
];
