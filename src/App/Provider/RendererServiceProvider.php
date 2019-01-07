<?php

declare(strict_types=1);

namespace Skeleton\App\Provider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Slim PHP Renderer service provider.
 */
class RendererServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        $pimple['renderer'] = function (\Slim\Container $c) {
            $settings = $c->get('settings')['renderer'];

            return new \Slim\Views\PhpRenderer($settings['template_path']);
        };
    }
}
