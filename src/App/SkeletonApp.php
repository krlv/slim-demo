<?php

declare(strict_types=1);

namespace Skeleton\App;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Slim\App;

/**
 * @method Container getContainer()
 */
class SkeletonApp extends App
{
    /**
     * Registers application dependencies.
     *
     * @return SkeletonApp
     */
    public function registerServices(): self
    {
        $this
            ->register(new Provider\SerializerServiceProvider())
            ->register(new Provider\RendererServiceProvider())
            ->register(new Provider\DbalServiceProvider())
            ->register(new Provider\LoggerServiceProvider())
        ;

        return $this;
    }

    /**
     * Registers application's controllers.
     *
     * @return SkeletonApp
     */
    public function registerControllers(): self
    {
        $c = $this->getContainer();

        $c['home_controller'] = static function (Container $c) {
            return new Controller\HomeController($c['renderer']);
        };

        $c['lists_controller'] = static function (Container $c) {
            return new Controller\ListsController($c['serializer']);
        };

        $c['tasks_controller'] = static function (Container $c) {
            return new Controller\TasksController($c['serializer']);
        };

        $c['tags_controller'] = static function (Container $c) {
            return new Controller\TagsController($c['serializer']);
        };

        return $this;
    }

    /**
     * Registers application middleware.
     *
     * @return SkeletonApp
     */
    public function registerMiddleware(): self
    {
        $c = $this->getContainer();

        $c['logger_middleware'] = static function (Container $c) {
            return new Middleware\LoggerMiddleware($c['logger']);
        };

        return $this;
    }

    /**
     * Registers application's routes.
     *
     * @return SkeletonApp
     */
    public function registerRoutes(): self
    {
        // Logger middleware, common for all routes
        $this->add('logger_middleware:handle');

        // Web routes
        $this->group('', Route\HomeRoute::class);

        // API routes
        $this->group('/api', function (): void {
            $this->group('/lists', Route\ListsRoute::class);
            $this->group('/lists/{list_id}/tasks', Route\TasksRoute::class);
            $this->group('/tags', Route\TagsRoute::class);
        });

        return $this;
    }

    /**
     * Registers a service provider.
     *
     * @param ServiceProviderInterface $provider Service provider
     * @param array                    $values   Array of values to configure service provider
     *
     * @return SkeletonApp
     */
    public function register(ServiceProviderInterface $provider, array $values = []): self
    {
        $this->getContainer()->register($provider, $values);

        return $this;
    }
}
