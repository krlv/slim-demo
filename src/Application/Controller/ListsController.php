<?php

declare(strict_types=1);

namespace Skeleton\Application\Controller;

use Fig\Http\Message\StatusCodeInterface as HttpCode;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Skeleton\Application\Serializer\Serializer;
use Skeleton\Domain\ListService;
use Valitron\Validator;

class ListsController
{
    private Validator $validator;
    private Serializer $serializer;
    private ListService $listService;

    public function __construct(Validator $validator, Serializer $serializer, ListService $taskListService)
    {
        $this->validator = $validator;
        $this->validator->rule('required', 'title');

        $this->serializer  = $serializer;
        $this->listService = $taskListService;
    }

    /**
     * @param string[] $args
     */
    public function getListsAction(Request $request, Response $response, array $args): Response
    {
        $lists = $this->listService->getLists();

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
        $list = $this->listService->getListById($id);

        // Return response as JSON
        return $this->serializer->serialize($response, $list);
    }

    /**
     * @param string[] $args
     */
    public function createListAction(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();

        $v = $this->validator->withData($data);
        if (!$v->validate()) {
            return $this->serializer->serialize($response, ['errors' => $v->errors()], HttpCode::STATUS_BAD_REQUEST);
        }

        $list = $this->listService->createList($data);

        // Return response as JSON with 201 Created code
        return $this->serializer->serialize($response, $list, HttpCode::STATUS_CREATED);
    }

    /**
     * @param string[] $args
     */
    public function updateListAction(Request $request, Response $response, array $args): Response
    {
        $id   = (int) $args['list_id'];
        $data = $request->getParsedBody();

        $v = $this->validator->withData($data);
        if (!$v->validate()) {
            return $this->serializer->serialize($response, ['errors' => $v->errors()], HttpCode::STATUS_BAD_REQUEST);
        }

        // TODO: handle not found exception
        $list = $this->listService->updateList($id, $data);

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
        $this->listService->deleteList($id);

        // Return empty response with 204 No Content code
        return $this->serializer->serialize($response, [], HttpCode::STATUS_NO_CONTENT);
    }
}
