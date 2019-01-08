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

    /**
     * @param Request  $request
     * @param Response $response
     * @param string[] $args
     *
     * @return Response
     */
    public function getCategoriesAction(Request $request, Response $response, array $args): Response
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

    /**
     * @param Request  $request
     * @param Response $response
     * @param string[] $args
     *
     * @return Response
     */
    public function getCategoryAction(Request $request, Response $response, array $args): Response
    {
        // TODO: fetch category by ID
        $category = [
            'id'    => $args['category_id'],
            'title' => 'Category ' . $args['category_id'],
        ];

        // Return response as JSON
        return $this->serializer->serialize($response, $category);
    }

    /**
     * @param Request  $request
     * @param Response $response
     * @param string[] $args
     *
     * @return Response
     */
    public function createCategoryAction(Request $request, Response $response, array $args): Response
    {
        // TODO: save new category
        $category = [
            'id'    => 1,
            'title' => 'Category 1',
        ];

        // Return response as JSON with 201 Created code
        return $this->serializer->serialize($response, $category, StatusCode::HTTP_CREATED);
    }

    /**
     * @param Request  $request
     * @param Response $response
     * @param string[] $args
     *
     * @return Response
     */
    public function updateCategoryAction(Request $request, Response $response, array $args): Response
    {
        // TODO: update existing category

        // Return response as JSON
        return $this->serializer->serialize($response, []);
    }

    /**
     * @param Request  $request
     * @param Response $response
     * @param string[] $args
     *
     * @return Response
     */
    public function deleteCategoryAction(Request $request, Response $response, array $args): Response
    {
        // TODO: delete existing category

        // Return empty response with 204 No Content code
        return $this->serializer->serialize($response, [], StatusCode::HTTP_NO_CONTENT);
    }
}
