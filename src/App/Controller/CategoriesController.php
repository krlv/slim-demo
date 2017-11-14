<?php

namespace Skeleton\App\Controller;

use Slim\Http\Request;
use Slim\Http\Response;

class CategoriesController
{
    public function getCategories(Request $request, Response $response, array $args)
    {
        // TODO: fetch list of categories
        $categories = [];

        // Return response as JSON
        return $response->withJson(['categories' => $categories]);
    }

    public function getCategory(Request $request, Response $response, array $args)
    {
        // TODO: fetch category by ID
        $task = [
            'id'    => $args['category_id'],
            'title' => 'Category ' . $args['category_id'],
        ];

        // Return response as JSON
        return $response->withJson(['task' => $task]);
    }

    public function createCategory(Request $request, Response $response, array $args)
    {
        // TODO: save new category

        // Return empty response with 201 Created code
        return $response->withJson(null, 201);
    }

    public function updateCategory(Request $request, Response $response, array $args)
    {
        // TODO: update existing category

        // Return empty response with 204 No Content code
        return $response->withJson(null, 204);
    }
}
