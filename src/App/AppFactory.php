<?php
namespace Skeletn\App;

use Slim\App;

/**
 * Class AppFactory
 *
 * @package Skeletn\App
 */
final class AppFactory
{
    /**
     * Create Application's instance
     *
     * @param array $config
     * @param bool $debug
     *
     * @return App
     */
    public static function createApp($config, $debug = false)
    {
        return (new App($config, $debug));
    }

    /**
     * Create Application's instance
     *
     * @param array $config
     * @param bool $debug
     *
     * @return App
     */
    public static function createTestApp($config, $debug = true)
    {
        return (new App($config, $debug));
    }
}