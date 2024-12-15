<?php

use DI\ContainerBuilder;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        'settings' => fn () => [
            'app' => require __DIR__ . '/../config/app.php',
            'web' => require __DIR__ . '/../config/app-web.php',
            'admin' => require __DIR__ . '/../config/app-admin.php',
            'logger' => require __DIR__ . '/../config/logger.php',
            'cache' => require __DIR__ . '/../config/cache.php',
            'database' => require __DIR__ . '/../config/database.php',
            'session' => require __DIR__ . '/../config/session.php',
        ]
    ]);
};
