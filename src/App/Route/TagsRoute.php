<?php
declare(strict_types=1);

namespace Skeleton\App\Route;

use Skeleton\App\SkeletonApp;

class TagsRoute
{
    /**
     * Register Tags API routes.
     *
     * @param SkeletonApp $app
     */
    public function __invoke(SkeletonApp $app)
    {
        $app->get('', 'tags_controller:getTagsAction');
        $app->get('/{tag_id}', 'tags_controller:getTagAction');
        $app->post('', 'tags_controller:createTagAction');
    }
}
