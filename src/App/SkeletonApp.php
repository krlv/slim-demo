<?php
namespace Skeleton\App;

class SkeletonApp extends \Slim\App
{
    public function registerServices(): SkeletonApp
    {
        // Set up dependencies
        require __DIR__ . '/../dependencies.php';
        return $this;
    }

    public function registerMiddleware(): SkeletonApp
    {
        // Register middleware
        require __DIR__ . '/../middleware.php';
        return $this;
    }

    public function registerRoutes(): SkeletonApp
    {
        // Register routes
        require __DIR__ . '/../routes.php';
        return $this;
    }
}