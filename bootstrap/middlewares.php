<?php

use App\Middlewares\ExceptionMiddleware;
use App\Middlewares\FrontendLocaleMiddleware;
use Middlewares\TrailingSlash;
use Slim\App;

return function (App $app, string $entry) {
    $container = $app->getContainer();
    $settings = $container->get('settings')['app'];

    $app->addBodyParsingMiddleware();
    $app->addRoutingMiddleware();
    $app->add(TrailingSlash::class);

    // 添加特定入口中間件
    if ($entry === 'web') {
        $localeMiddleware = $app->getContainer()->get(FrontendLocaleMiddleware::class);
        $app->add($localeMiddleware);
    }

    $app->add(ExceptionMiddleware::class);
    $app->addErrorMiddleware(true, true, $settings['debug']);
};
