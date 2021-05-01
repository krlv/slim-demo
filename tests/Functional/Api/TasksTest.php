<?php

declare(strict_types=1);

namespace Demo\Test\Functional\Api;

use Demo\Test\Functional\WebTestCase;

final class TasksTest extends WebTestCase
{
    public function testGetTasksAction(): void
    {
        $this->request('GET', '/api/lists/1/tasks', ['Content-Type' => 'application/json']);
        $this->assertStatusCode(200);
    }

    public function testGetEmptyTasksAction(): void
    {
        $this->request('GET', '/api/lists/1/tasks', ['Content-Type' => 'application/json']);
        $this->assertStatusCode(200);
    }

    public function testGetTaskByIdAction(): void
    {
        $this->request('GET', '/api/lists/1/tasks/1', ['Content-Type' => 'application/json']);
        $this->assertJsonResponse([
            'id'            => 1,
            'title'         => 'Task 1',
            'description'   => 'Description 1',
            'priority'      => 1,
            'is_done'       => false,
            'is_deleted'    => false,
        ], 200);
    }

    public function testGetTaskByNonExistingIdAction(): void
    {
        $this->request('GET', '/api/lists/1/tasks/1', ['Content-Type' => 'application/json']);
        $this->assertJsonResponse([
            'id'            => 1,
            'title'         => 'Task 1',
            'description'   => 'Description 1',
            'priority'      => 1,
            'is_done'       => false,
            'is_deleted'    => false,
        ], 200);
    }

    public function testCreateTaskAction(): void
    {
        $this->request('POST', '/api/lists/1/tasks', [
            'Content-Type' => 'application/json',
        ], [], [], [
            'title'         => 'Task 1',
            'description'   => 'Description 1',
        ]);
        $this->assertJsonResponse([
            'id'            => 1,
            'title'         => 'Task 1',
            'description'   => 'Description 1',
            'priority'      => 0,
            'is_done'       => false,
            'is_deleted'    => false,
        ], 201);
    }

    public function testUpdateTaskAction(): void
    {
        $this->request('PUT', '/api/lists/1/tasks/1', [
            'Content-Type' => 'application/json',
        ], [], [], [
            'title'         => 'Task 1',
            'description'   => 'Description 1',
        ]);
        $this->assertJsonResponse([
            'id'            => 1,
            'title'         => 'Task 1',
            'description'   => 'Description 1',
            'priority'      => 1,
            'is_done'       => false,
            'is_deleted'    => false,
        ], 200);
    }

    public function testUpdateNonExistingTaskAction(): void
    {
        $this->request('PUT', '/api/lists/1/tasks/1', [
            'Content-Type' => 'application/json',
        ], [], [], [
            'title'         => 'Task 1',
            'description'   => 'Description 1',
        ]);
        $this->assertJsonResponse([
            'id'            => 1,
            'title'         => 'Task 1',
            'description'   => 'Description 1',
            'priority'      => 1,
            'is_done'       => false,
            'is_deleted'    => false,
        ], 200);
    }

    public function testDeleteTaskAction(): void
    {
        $this->request('DELETE', '/api/lists/1/tasks/1', ['Content-Type' => 'application/json']);
        $this->assertStatusCode(204);
    }

    public function testDeleteNonExistingTaskAction(): void
    {
        $this->request('DELETE', '/api/lists/1/tasks/1', ['Content-Type' => 'application/json']);
        $this->assertStatusCode(204);
    }
}
