<?php

declare(strict_types=1);

namespace Skeleton\App\Controller;

use Skeleton\App\Serializer\Serializer;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\StatusCode;

class ListsController
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
    public function getListsAction(Request $request, Response $response, array $args): Response
    {
        // TODO: fetch list of task lists
        $lists = [
            [
                'id'    => 1,
                'title' => 'Task List 1',
            ],
            [
                'id'    => 2,
                'title' => 'Task List 2',
            ],
        ];

        // Return response as JSON
        return $this->serializer->serialize($response, $lists);
    }

    /**
     * @param Request  $request
     * @param Response $response
     * @param string[] $args
     *
     * @return Response
     */
    public function getListAction(Request $request, Response $response, array $args): Response
    {
        // TODO: fetch list by ID
        $list = [
            'id'    => $args['list_id'],
            'title' => 'Task List ' . $args['list_id'],
        ];

        // Return response as JSON
        return $this->serializer->serialize($response, $list);
    }

    /**
     * @param Request  $request
     * @param Response $response
     * @param string[] $args
     *
     * @return Response
     */
    public function createListAction(Request $request, Response $response, array $args): Response
    {
        // TODO: create new list
        $list = $request->getParsedBody();
        $list = \array_merge(['id' => '1'], $list);

        // Return response as JSON with 201 Created code
        return $this->serializer->serialize($response, $list, StatusCode::HTTP_CREATED);
    }

    /**
     * @param Request  $request
     * @param Response $response
     * @param string[] $args
     *
     * @return Response
     */
    public function updateListAction(Request $request, Response $response, array $args): Response
    {
        // TODO: update existing task list
        $list = $request->getParsedBody();
        $list = \array_merge(['id' => $args['list_id']], $list);

        // Return response as JSON
        return $this->serializer->serialize($response, $list);
    }

    /**
     * @param Request  $request
     * @param Response $response
     * @param string[] $args
     *
     * @return Response
     */
    public function deleteListAction(Request $request, Response $response, array $args): Response
    {
        // TODO: delete existing task list

        // Return empty response with 204 No Content code
        return $this->serializer->serialize($response, [], StatusCode::HTTP_NO_CONTENT);
    }
}
