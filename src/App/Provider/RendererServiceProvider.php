<?php

declare(strict_types=1);

namespace Skeleton\App\Provider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Slim\Views\PhpRenderer;

/**
 * Slim PHP Renderer service provider.
 */
class RendererServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple): void
    {
        $pimple['renderer'] = static function (Container $c) {
            $settings = $c->offsetGet('settings')['renderer'];

            return new PhpRenderer($settings['template_path']);
        };
    }
}
