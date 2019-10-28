<?php

declare(strict_types=1);

namespace Skeleton\App\Route;

use Slim\Interfaces\RouteCollectorProxyInterface;

class HomeRoute
{
    /**
     * Register Home web routes.
     *
     * @param RouteCollectorProxyInterface $app
     */
    public function __invoke(RouteCollectorProxyInterface $app): void
    {
        $app->get('/[{name}]', 'home_controller:indexAction');
    }
}
