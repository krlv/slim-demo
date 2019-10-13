<?php

declare(strict_types=1);

namespace Skeleton\App\Controller;

use Skeleton\App\Serializer\Serializer;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\StatusCode;

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
     * @param Request  $request
     * @param Response $response
     * @param string[] $args
     *
     * @return Response
     */
    public function getTasksAction(Request $request, Response $response, array $args): Response
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
     * @param Request  $request
     * @param Response $response
     * @param string[] $args
     *
     * @return Response
     */
    public function getTaskAction(Request $request, Response $response, array $args): Response
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
     * @param Request  $request
     * @param Response $response
     * @param string[] $args
     *
     * @return Response
     */
    public function createTaskAction(Request $request, Response $response, array $args): Response
    {
        // TODO: save new task
        $task = $request->getParsedBody();
        $task = \array_merge(['id' => '1'], $task);

        // Return response as JSON with 201 Created code
        return $this->serializer->serialize($response, $task, StatusCode::HTTP_CREATED);
    }

    /**
     * @param Request  $request
     * @param Response $response
     * @param string[] $args
     *
     * @return Response
     */
    public function updateTaskAction(Request $request, Response $response, array $args): Response
    {
        // TODO: update existing task
        $task = $request->getParsedBody();
        $task = \array_merge(['id' => $args['task_id']], $task);

        // Return response as JSON
        return $this->serializer->serialize($response, $task);
    }

    /**
     * @param Request  $request
     * @param Response $response
     * @param string[] $args
     *
     * @return Response
     */
    public function deleteTaskAction(Request $request, Response $response, array $args): Response
    {
        // TODO: delete existing task
        // Return empty response with 204 No Content code
        return $this->serializer->serialize($response, [], StatusCode::HTTP_NO_CONTENT);
    }
}
