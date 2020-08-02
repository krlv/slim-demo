<?php

declare(strict_types=1);

namespace Skeleton\App\Route;

use Slim\Interfaces\RouteCollectorProxyInterface;

class TagsRoute
{
    /**
     * Register Tags API routes.
     */
    public function __invoke(RouteCollectorProxyInterface $app): void
    {
        $app->get('', 'tags_controller:getTagsAction');
        $app->get('/{tag_id}', 'tags_controller:getTagAction');
        $app->post('', 'tags_controller:createTagAction');
    }
}
