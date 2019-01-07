<?php

declare(strict_types=1);

namespace Skeleton\App;

/**
 * Class AppFactory.
 */
final class AppFactory
{
    /**
     * Create Application's instance.
     *
     * @param array $config
     * @param bool  $debug
     *
     * @return SkeletonApp
     */
    public static function createApp(array $config, bool $debug = false): SkeletonApp
    {
        return (new SkeletonApp($config))
            ->registerServices()
            ->registerMiddleware()
            ->registerControllers()
            ->registerRoutes()
        ;
    }

    /**
     * Create Application's instance.
     *
     * @param array $config
     * @param bool  $debug
     *
     * @return SkeletonApp
     */
    public static function createTestApp(array $config, bool $debug = true): SkeletonApp
    {
        return (new SkeletonApp($config))
            ->registerServices()
            ->registerMiddleware()
            ->registerControllers()
            ->registerRoutes()
        ;
    }
}
