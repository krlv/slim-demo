<?php

declare(strict_types=1);

namespace Skeleton\App\Route;

use Skeleton\App\SkeletonApp;

class CategoriesRoute
{
    /**
     * Register Categories API routes.
     *
     * @param SkeletonApp $app
     */
    public function __invoke(SkeletonApp $app): void
    {
        $app->get('', 'categories_controller:getCategoriesAction');
        $app->get('/{category_id}', 'categories_controller:getCategoryAction');
        $app->post('', 'categories_controller:createCategoryAction');
        $app->put('/{category_id}', 'categories_controller:updateCategoryAction');
        $app->delete('/{category_id}', 'categories_controller:deleteCategoryAction');
    }
}
