<?php

namespace App\Providers;

use App\Interfaces\ServiceProviderInterface;
use App\Middlewares\ExceptionMiddleware;
use App\Middlewares\FrontendLocaleMiddleware;
use App\Renderers\JsonRenderer;
use DI\ContainerBuilder;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use PDO;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;
use Slim\Psr7\Factory\ResponseFactory;

class AppServiceProvider implements ServiceProviderInterface
{
    public function register(ContainerBuilder $containerBuilder): void
    {
        $containerBuilder->addDefinitions([
            ResponseFactoryInterface::class => function () {
                return new ResponseFactory();
            },
            ExceptionMiddleware::class => function (ContainerInterface $container) {
                $settings = $container->get('settings');

                return new ExceptionMiddleware(
                    $container->get(ResponseFactoryInterface::class),
                    $container->get(JsonRenderer::class),
                    $container->get(LoggerInterface::class),
                    $settings['app']['debug'],
                );
            },
            LoggerInterface::class => function (ContainerInterface $container) {
                $settings = $container->get('settings');
                $logger = new Logger($settings['logger']['name']);

                $handler = new StreamHandler(
                    $settings['logger']['path'],
                    $settings['app']['debug'] ? LogLevel::DEBUG : LogLevel::INFO
                );
                $handler->setFormatter(new LineFormatter(null, null, true, true));
                $logger->pushHandler($handler);

                return $logger;
            },
            PDO::class => function (ContainerInterface $container) {
                $settings = $container->get('settings')['database'];

                $dsn = sprintf(
                    "mysql:host=%s;dbname=%s;charset=utf8mb4",
                    $settings['host'],
                    $settings['database']
                );

                $pdo = new PDO($dsn, $settings['username'], $settings['password']);
                $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                return $pdo;
            },
            FrontendLocaleMiddleware::class => function (ContainerInterface $container) {
                $settings = $container->get('settings');
                $defaultLocale = $settings['web']['default_locale'];
                $pdo = $container->get(PDO::class);
                return new FrontendLocaleMiddleware($pdo, $defaultLocale);
            },
        ]);
    }
}
