<?php

use App\Bootstrap\Env;
use DI\ContainerBuilder;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

Env::initialize(dirname(__DIR__));

return function ($entry) {

    $containerBuilder = new ContainerBuilder();

    $settings = require __DIR__ . '/settings.php';
    $settings($containerBuilder);

    $providers = require __DIR__ . '/providers.php';
    $providers($containerBuilder);

    $container = require __DIR__ . '/container.php';
    AppFactory::setContainer($container($containerBuilder));
    $app = AppFactory::create();
    if ($entry == 'admin') {
        $app->setBasePath('/admin');
    }

    // 加载全局中间件（根据环境名）
    $middlewares = require __DIR__ . '/middlewares.php';
    $middlewares($app, $entry);

    // 加载路由
    $routes = require __DIR__ . '/routes.php';
    $routes($app, $entry);

    return $app;
};
