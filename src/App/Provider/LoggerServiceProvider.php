<?php

declare(strict_types=1);

namespace Skeleton\App\Provider;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Monolog logger service provider.
 */
class LoggerServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple): void
    {
        $pimple['logger'] = static function (Container $c) {
            $settings = $c->offsetGet('settings')['logger'];

            $logger = new Logger($settings['name']);
            $logger->pushProcessor(new UidProcessor());
            $logger->pushHandler(new StreamHandler($settings['path'], Logger::DEBUG));

            return $logger;
        };
    }
}
