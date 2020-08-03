<?php

declare(strict_types=1);

namespace Skeleton\App;

use Pimple\Container;
use Slim\App;

final class AppFactory
{
    /**
     * Create Application's instance.
     */
    public static function createApp(array $config, bool $displayErrors = false): App
    {
        $container = new Container($config);
        $container
            ->register(new Provider\SerializerServiceProvider())
            ->register(new Provider\RendererServiceProvider())
            ->register(new Provider\DbalServiceProvider())
            ->register(new Provider\LoggerServiceProvider())
            ->register(new Provider\ControllerServiceProvider())
        ;

        $container = new \Pimple\Psr11\Container($container);
        $app       = \Slim\Factory\AppFactory::createFromContainer($container);

        // Register global middleware
        $middleware = require __DIR__ . '/../../config/middleware.php';
        $middleware($app);

        // Register routes
        $routes = require __DIR__ . '/../../config/routes.php';
        $routes($app);

        // Built-in Slim middleware: routing and error handling
        $app->addRoutingMiddleware();
        $app->addErrorMiddleware($displayErrors, true, true);

        return $app;
    }
}
