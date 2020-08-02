<?php

declare(strict_types=1);

namespace Skeleton\App\Controller;

use Fig\Http\Message\StatusCodeInterface as HttpCode;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Skeleton\App\Serializer\Serializer;

class TasksController
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
     * @param string[] $args
     */
    public function getTasksAction(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        // TODO: fetch list of tasks
        $tasks = [
            [
                'id'    => 1,
                'title' => 'Task 1',
            ],
            [
                'id'    => 2,
                'title' => 'Task 2',
            ],
        ];

        // Return response as JSON
        return $this->serializer->serialize($response, $tasks);
    }

    /**
     * @param string[] $args
     */
    public function getTaskAction(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        // TODO: fetch task by ID
        $task = [
            'id'    => $args['task_id'],
            'title' => 'Task ' . $args['task_id'],
        ];

        // Return response as JSON
        return $this->serializer->serialize($response, $task);
    }

    /**
     * @param string[] $args
     */
    public function createTaskAction(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        // TODO: save new task
        $task = $request->getParsedBody();
        $task = \array_merge(['id' => '1'], $task);

        // Return response as JSON with 201 Created code
        return $this->serializer->serialize($response, $task, HttpCode::STATUS_CREATED);
    }

    /**
     * @param string[] $args
     */
    public function updateTaskAction(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        // TODO: update existing task
        $task = $request->getParsedBody();
        $task = \array_merge(['id' => $args['task_id']], $task);

        // Return response as JSON
        return $this->serializer->serialize($response, $task);
    }

    /**
     * @param string[] $args
     */
    public function deleteTaskAction(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        // TODO: delete existing task
        // Return empty response with 204 No Content code
        return $this->serializer->serialize($response, [], HttpCode::STATUS_NO_CONTENT);
    }
}
