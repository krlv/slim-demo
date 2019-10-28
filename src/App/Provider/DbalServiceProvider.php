<?php

declare(strict_types=1);

namespace Skeleton\App\Provider;

use Doctrine\DBAL\DriverManager;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Doctrine DBAL service provider.
 */
class DbalServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple): void
    {
        $pimple['dbal'] = static function (Container $c) {
            $settings = $c->offsetGet('settings')['dbal'];

            return DriverManager::getConnection($settings);
        };
    }
}
