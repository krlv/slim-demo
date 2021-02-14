<?php

declare(strict_types=1);

namespace Skeleton\Application\Controller;

use Fig\Http\Message\StatusCodeInterface as HttpCode;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Skeleton\Application\Serializer\Serializer;
use Skeleton\Domain\TaskListService;

class ListsController
{
    private Serializer $serializer;
    private TaskListService $taskListService;

    public function __construct(Serializer $serializer, TaskListService $taskListService)
    {
        $this->serializer      = $serializer;
        $this->taskListService = $taskListService;
    }

    /**
     * @param string[] $args
     */
    public function getListsAction(Request $request, Response $response, array $args): Response
    {
        $lists = $this->taskListService->getLists();

        // Return response as JSON
        return $this->serializer->serialize($response, $lists);
    }

    /**
     * @param string[] $args
     */
    public function getListAction(Request $request, Response $response, array $args): Response
    {
        $id = (int) $args['list_id'];

        // TODO: handle not found exception
        $list = $this->taskListService->getListById($id);

        // Return response as JSON
        return $this->serializer->serialize($response, $list);
    }

    /**
     * @param string[] $args
     */
    public function createListAction(Request $request, Response $response, array $args): Response
    {
        // TODO: validate payload
        $data = $request->getParsedBody();

        $list = $this->taskListService->createList($data);

        // Return response as JSON with 201 Created code
        return $this->serializer->serialize($response, $list, HttpCode::STATUS_CREATED);
    }

    /**
     * @param string[] $args
     */
    public function updateListAction(Request $request, Response $response, array $args): Response
    {
        // TODO: validate payload
        $id   = (int) $args['list_id'];
        $data = $request->getParsedBody();

        // TODO: handle not found exception
        $list = $this->taskListService->updateList($id, $data);

        // Return response as JSON
        return $this->serializer->serialize($response, $list);
    }

    /**
     * @param string[] $args
     */
    public function deleteListAction(Request $request, Response $response, array $args): Response
    {
        $id = (int) $args['list_id'];

        // TODO: handle not found exception
        $this->taskListService->deleteList($id);

        // Return empty response with 204 No Content code
        return $this->serializer->serialize($response, [], HttpCode::STATUS_NO_CONTENT);
    }
}
