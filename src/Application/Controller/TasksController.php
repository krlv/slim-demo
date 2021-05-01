<?php

declare(strict_types=1);

namespace Demo\Application\Controller;

use Demo\Application\Serializer\Serializer;
use Demo\Domain\TaskService;
use Fig\Http\Message\StatusCodeInterface as HttpCode;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class TasksController
{
    private Serializer $serializer;
    private TaskService $taskService;

    public function __construct(Serializer $serializer, TaskService $taskService)
    {
        $this->serializer  = $serializer;
        $this->taskService = $taskService;
    }

    /**
     * @param string[] $args
     */
    public function getTasksAction(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $tasks = $this->taskService->getTasks();

        // Return response as JSON
        return $this->serializer->serialize($response, $tasks);
    }

    /**
     * @param string[] $args
     */
    public function getTaskAction(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $id = (int) $args['task_id'];

        // TODO: handle not found exception
        $task = $this->taskService->getTaskById($id);

        // Return response as JSON
        return $this->serializer->serialize($response, $task);
    }

    /**
     * @param string[] $args
     */
    public function createTaskAction(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        // TODO: validate payload
        $data = $request->getParsedBody();

        $task = $this->taskService->createTask($data);

        // Return response as JSON with 201 Created code
        return $this->serializer->serialize($response, $task, HttpCode::STATUS_CREATED);
    }

    /**
     * @param string[] $args
     */
    public function updateTaskAction(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        // TODO: validate payload
        $id   = (int) $args['task_id'];
        $data = $request->getParsedBody();

        // TODO: handle not found exception
        $task = $this->taskService->updateTask($id, $data);

        // Return response as JSON
        return $this->serializer->serialize($response, $task);
    }

    /**
     * @param string[] $args
     */
    public function deleteTaskAction(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $id = (int) $args['task_id'];

        // TODO: handle not found exception
        $this->taskService->deleteTask($id);

        // Return empty response with 204 No Content code
        return $this->serializer->serialize($response, [], HttpCode::STATUS_NO_CONTENT);
    }
}
