<?php
namespace Skeleton\App;

use Pimple\ServiceProviderInterface;
use Psr\Container\ContainerInterface;

class SkeletonApp extends \Slim\App
{
    /**
     * Registers application dependencies
     *
     * @return SkeletonApp
     */
    public function registerServices(): self
    {
        $this
            ->register(new Provider\RendererServiceProvider())
            ->register(new Provider\DbalServiceProvider())
            ->register(new Provider\LoggerServiceProvider())
        ;

        return $this;
    }

    /**
     * Registers application's controllers
     *
     * @return SkeletonApp
     */
    public function registerControllers(): self
    {
        $cnt = $this->getContainer();

        $cnt['home_controller'] = function (ContainerInterface $cnt) {
            return new Controller\HomeController($cnt['renderer']);
        };

        $cnt['tasks_controller'] = function () {
            return new Controller\TasksController();
        };

        $cnt['categories_controller'] = function () {
            return new Controller\CategoriesController();
        };

        $cnt['tags_controller'] = function () {
            return new Controller\TagsController();
        };

        return $this;
    }

    /**
     * Registers application middleware
     *
     * @return SkeletonApp
     */
    public function registerMiddleware(): SkeletonApp
    {
        $cnt = $this->getContainer();

        $cnt['logger_middleware'] = function (ContainerInterface $cnt) {
            return new Middleware\LoggerMiddleware($cnt['logger']);
        };

        return $this;
    }

    /**
     * Registers application's routes
     *
     * @return SkeletonApp
     */
    public function registerRoutes(): SkeletonApp
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
     * Registers a service provider
     *
     * @param ServiceProviderInterface $provider Service provider
     * @param array $values Array of values to configure service provider
     *
     * @return SkeletonApp
     */
    public function register(ServiceProviderInterface $provider, array $values = []): SkeletonApp
    {
        $this->getContainer()->register($provider, $values);
        return $this;
    }
}