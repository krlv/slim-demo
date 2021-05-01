<?php

declare(strict_types=1);

namespace Demo\Application;

use DI\ContainerBuilder;
use Slim\App;

final class AppFactory
{
    /**
     * Create Application's instance.
     */
    public static function createApp(bool $displayErrors = false): App
    {
        $containerBuilder = new ContainerBuilder();

        // TODO: enable DI container compilation

        // Load app configs
        $settings = require __DIR__ . '/../../config/settings.php';
        $settings($containerBuilder);

        // Set up services and dependencies
        $services = require __DIR__ . '/../../config/services.php';
        $services($containerBuilder);

        // Build DI container and instantiate the app
        $container = $containerBuilder->build();
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
