<?php

declare(strict_types=1);

namespace Skeleton\App\Route;

use Slim\Interfaces\RouteCollectorProxyInterface;

class ListsRoute
{
    /**
     * Register Categories API routes.
     */
    public function __invoke(RouteCollectorProxyInterface $app): void
    {
        $app->get('', 'lists_controller:getListsAction');
        $app->get('/{list_id}', 'lists_controller:getListAction');
        $app->post('', 'lists_controller:createListAction');
        $app->put('/{list_id}', 'lists_controller:updateListAction');
        $app->delete('/{list_id}', 'lists_controller:deleteListAction');
    }
}
