<?php

declare(strict_types=1);

namespace Skeleton\App\Route;

use Skeleton\App\SkeletonApp;

class ListsRoute
{
    /**
     * Register Categories API routes.
     *
     * @param SkeletonApp $app
     */
    public function __invoke(SkeletonApp $app): void
    {
        $app->get('', 'lists_controller:getListsAction');
        $app->get('/{list_id}', 'lists_controller:getListAction');
        $app->post('', 'lists_controller:createListAction');
        $app->put('/{list_id}', 'lists_controller:updateListAction');
        $app->delete('/{list_id}', 'lists_controller:deleteListAction');
    }
}
