<?php

declare(strict_types=1);

namespace Skeleton\App\Provider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Monolog logger service provider.
 */
class LoggerServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple): void
    {
        $pimple['logger'] = function (\Slim\Container $c) {
            $settings = $c->get('settings')['logger'];

            $logger = new \Monolog\Logger($settings['name']);
            $logger->pushProcessor(new \Monolog\Processor\UidProcessor());
            $logger->pushHandler(new \Monolog\Handler\StreamHandler($settings['path'], \Monolog\Logger::DEBUG));

            return $logger;
        };
    }
}
