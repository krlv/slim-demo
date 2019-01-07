<?php

declare(strict_types=1);

namespace Skeleton\App\Route;

use Skeleton\App\SkeletonApp;

class HomeRoute
{
    /**
     * Register Home web routes.
     *
     * @param SkeletonApp $app
     */
    public function __invoke(SkeletonApp $app)
    {
        $app->get('/[{name}]', 'home_controller:indexAction');
    }
}
