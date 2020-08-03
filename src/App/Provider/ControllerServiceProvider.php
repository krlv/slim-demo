<?php

declare(strict_types=1);

namespace Skeleton\App\Provider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Skeleton\App\Controller;
use Skeleton\App\Middleware;

/**
 * Controllers service provider.
 */
final class ControllerServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple): void
    {
        $pimple[Controller\HomeController::class] = static function (Container $c) {
            return new Controller\HomeController($c['renderer']);
        };

        $pimple[Controller\ListsController::class] = static function (Container $c) {
            return new Controller\ListsController($c['serializer']);
        };

        $pimple[Controller\TasksController::class] = static function (Container $c) {
            return new Controller\TasksController($c['serializer']);
        };

        $pimple[Controller\TagsController::class] = static function (Container $c) {
            return new Controller\TagsController($c['serializer']);
        };

        // TODO: find a better place for middleware
        $pimple[Middleware\LoggerMiddleware::class] = static function (Container $c) {
            return new Middleware\LoggerMiddleware($c['logger']);
        };
    }
}
