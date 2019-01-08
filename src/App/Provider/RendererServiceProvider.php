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
        $pimple['renderer'] = static function (\Slim\Container $c) {
            $settings = $c->get('settings')['renderer'];

            return new PhpRenderer($settings['template_path']);
        };
    }
}
