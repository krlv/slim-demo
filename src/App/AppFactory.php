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
    public static function createApp(array $config, bool $debug = false): App
    {
        $container = new Container($config);
        $container
            ->register(new Provider\SerializerServiceProvider())
            ->register(new Provider\RendererServiceProvider())
            ->register(new Provider\DbalServiceProvider())
            ->register(new Provider\LoggerServiceProvider())
        ;

        $container['logger_middleware'] = static function (Container $c) {
            return new Middleware\LoggerMiddleware($c['logger']);
        };

        $container['home_controller'] = static function (Container $c) {
            return new Controller\HomeController($c['renderer']);
        };

        $container['lists_controller'] = static function (Container $c) {
            return new Controller\ListsController($c['serializer']);
        };

        $container['tasks_controller'] = static function (Container $c) {
            return new Controller\TasksController($c['serializer']);
        };

        $container['tags_controller'] = static function (Container $c) {
            return new Controller\TagsController($c['serializer']);
        };

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
        $app->addErrorMiddleware(false, true, true);

        return $app;
    }

    /**
     * Create Application's instance.
     */
    public static function createTestApp(array $config, bool $debug = true): App
    {
        $container = new Container($config);
        $container
            ->register(new Provider\SerializerServiceProvider())
            ->register(new Provider\RendererServiceProvider())
            ->register(new Provider\DbalServiceProvider())
            ->register(new Provider\LoggerServiceProvider())
        ;

        $container['logger_middleware'] = static function (Container $c) {
            return new Middleware\LoggerMiddleware($c['logger']);
        };

        $container['home_controller'] = static function (Container $c) {
            return new Controller\HomeController($c['renderer']);
        };

        $container['lists_controller'] = static function (Container $c) {
            return new Controller\ListsController($c['serializer']);
        };

        $container['tasks_controller'] = static function (Container $c) {
            return new Controller\TasksController($c['serializer']);
        };

        $container['tags_controller'] = static function (Container $c) {
            return new Controller\TagsController($c['serializer']);
        };

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
        $app->addErrorMiddleware(true, true, true);

        return $app;
    }
}
