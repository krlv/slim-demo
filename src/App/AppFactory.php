<?php

declare(strict_types=1);

namespace Skeleton\App;

use Middlewares\TrailingSlash;
use Pimple\Container;
use Slim\App;

final class AppFactory
{
    /**
     * Create Application's instance.
     *
     * @param array $config
     * @param bool  $debug
     *
     * @return App
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

        // Logger middleware, common for all routes
        $app->add('logger_middleware:handle');

        // Web routes
        $app->group('', Route\HomeRoute::class);

        // API routes
        $app->group('/api', function ($app): void {
            $app->group('/lists', Route\ListsRoute::class);
            $app->group('/lists/{list_id}/tasks', Route\TasksRoute::class);
            $app->group('/tags', Route\TagsRoute::class);
        });

        $app->addRoutingMiddleware();
        $app->add(new TrailingSlash(false));

        return $app;
    }

    /**
     * Create Application's instance.
     *
     * @param array $config
     * @param bool  $debug
     *
     * @return App
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

        // Logger middleware, common for all routes
        $app->add('logger_middleware:handle');

        // Web routes
        $app->group('', Route\HomeRoute::class);

        // API routes
        $app->group('/api', function ($app): void {
            $app->group('/lists', Route\ListsRoute::class);
            $app->group('/lists/{list_id}/tasks', Route\TasksRoute::class);
            $app->group('/tags', Route\TagsRoute::class);
        });

        $app->addRoutingMiddleware();
        $app->add(new TrailingSlash(false));
        $app->addErrorMiddleware(true, true, true);

        return $app;
    }
}
