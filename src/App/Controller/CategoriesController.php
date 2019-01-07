<?php

declare(strict_types=1);

namespace Skeleton\App\Controller;

use Skeleton\App\Serializer\Serializer;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\StatusCode;

class CategoriesController
{
    /**
     * @var Serializer
     */
    private $serializer;

    public function __construct(Serializer $serializer)
    {
        $this->serializer = $serializer;
    }

    public function getCategoriesAction(Request $request, Response $response, array $args)
    {
        // TODO: fetch list of categories
        $categories = [
            [
                'id'    => 1,
                'title' => 'Category 1',
            ],
            [
                'id'    => 2,
                'title' => 'Category 2',
            ],
        ];

        // Return response as JSON
        return $this->serializer->serialize($response, $categories);
    }

    public function getCategoryAction(Request $request, Response $response, array $args)
    {
        // TODO: fetch category by ID
        $category = [
            'id'    => $args['category_id'],
            'title' => 'Category ' . $args['category_id'],
        ];

        // Return response as JSON
        return $this->serializer->serialize($response, $category);
    }

    public function createCategoryAction(Request $request, Response $response, array $args)
    {
        // TODO: save new category
        $category = [
            'id'    => 1,
            'title' => 'Category 1',
        ];

        // Return response as JSON with 201 Created code
        return $this->serializer->serialize($response, $category, StatusCode::HTTP_CREATED);
    }

    public function updateCategoryAction(Request $request, Response $response, array $args)
    {
        // TODO: update existing category

        // Return response as JSON
        return $this->serializer->serialize($response, []);
    }

    public function deleteCategoryAction(Request $request, Response $response, array $args)
    {
        // TODO: delete existing category

        // Return empty response with 204 No Content code
        return $this->serializer->serialize($response, [], StatusCode::HTTP_NO_CONTENT);
    }
}
