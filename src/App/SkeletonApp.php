<?php

declare(strict_types=1);

namespace Skeleton\App;

use Pimple\ServiceProviderInterface;
use Psr\Container\ContainerInterface;

class SkeletonApp extends \Slim\App
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

        $c['home_controller'] = function (ContainerInterface $c) {
            return new Controller\HomeController($c['renderer']);
        };

        $c['tasks_controller'] = function (ContainerInterface $c) {
            return new Controller\TasksController($c['serializer']);
        };

        $c['categories_controller'] = function (ContainerInterface $c) {
            return new Controller\CategoriesController($c['serializer']);
        };

        $c['tags_controller'] = function (ContainerInterface $c) {
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

        $c['logger_middleware'] = function (ContainerInterface $c) {
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
        $this->group('/api', function () {
            $this->group('/tasks', Route\TasksRoute::class);
            $this->group('/categories', Route\CategoriesRoute::class);
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
