<?php
namespace Skeleton\App;

use Pimple\ServiceProviderInterface;

class SkeletonApp extends \Slim\App
{
    /**
     * Registers application dependencies
     *
     * @return SkeletonApp
     */
    public function registerServices(): SkeletonApp
    {
        $this
            ->register(new Provider\RendererServiceProvider())
            ->register(new Provider\DbalServiceProvider())
            ->register(new Provider\LoggerServiceProvider())
        ;

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
     * Registers application routes
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