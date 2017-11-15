<?php
namespace Skeleton\App;

use Pimple\ServiceProviderInterface;
use Skeleton\App\Controller\CategoriesController;
use Skeleton\App\Controller\HomeController;
use Skeleton\App\Controller\TagsController;
use Skeleton\App\Controller\TasksController;

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
        $pimple = $this->getContainer();

        $pimple['home_controller'] = function (\Slim\Container $c) {
            return new HomeController($c['renderer']);
        };

        $pimple['tasks_controller'] = function () {
            return new TasksController();
        };

        $pimple['categories_controller'] = function () {
            return new CategoriesController();
        };

        $pimple['tags_controller'] = function () {
            return new TagsController();
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
        // Register middleware
        require __DIR__ . '/../middleware.php';
        return $this;
    }

    /**
     * Registers application's routes
     *
     * @return SkeletonApp
     */
    public function registerRoutes(): SkeletonApp
    {
        // Register routes
        require __DIR__ . '/../routes.php';
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