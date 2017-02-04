<?php
namespace Skeleton\App\Provider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Doctrine DBAL service provider
 */
class DbalServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        $pimple['db'] = function (\Slim\Container $c) {
            $settings = $c->get('settings')['db'];
            return \Doctrine\DBAL\DriverManager::getConnection($settings);
        };
    }
}