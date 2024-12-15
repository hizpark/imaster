<?php

use Slim\App;

return function (App $app, string $entry) {

    $adminRoutes = require __DIR__ . "/../routes/$entry.php";

    foreach ($adminRoutes as $route) {
        $routeDefinition = $app->map([$route['method']], $route['path'], $route['handler']);
        if (isset($route['middlewares']) && is_array($route['middlewares'])) {
            foreach ($route['middlewares'] as $middleware) {
                $routeDefinition->add(new $middleware());
            }
        }
    }
};
