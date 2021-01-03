<?php

declare(strict_types=1);

namespace Skeleton\Application\Controller;

use Fig\Http\Message\StatusCodeInterface as HttpCode;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Skeleton\Application\Serializer\Serializer;

class ListsController
{
    private Serializer $serializer;

    public function __construct(Serializer $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @param string[] $args
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
     * @param string[] $args
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
     * @param string[] $args
     */
    public function createListAction(Request $request, Response $response, array $args): Response
    {
        // TODO: create new list
        $list = $request->getParsedBody();
        $list = \array_merge(['id' => '1'], $list);

        // Return response as JSON with 201 Created code
        return $this->serializer->serialize($response, $list, HttpCode::STATUS_CREATED);
    }

    /**
     * @param string[] $args
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
     * @param string[] $args
     */
    public function deleteListAction(Request $request, Response $response, array $args): Response
    {
        // TODO: delete existing task list
        // Return empty response with 204 No Content code
        return $this->serializer->serialize($response, [], HttpCode::STATUS_NO_CONTENT);
    }
}
