<?php
declare(strict_types=1);

namespace Skeleton\App\Provider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Doctrine DBAL service provider.
 */
class DbalServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        $pimple['dbal'] = function (\Slim\Container $c) {
            $settings = $c->get('settings')['dbal'];

            return \Doctrine\DBAL\DriverManager::getConnection($settings);
        };
    }
}
