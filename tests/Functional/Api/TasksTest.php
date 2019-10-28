<?php

declare(strict_types=1);

namespace Skeleton\Test\Functional\Api;

use Skeleton\Test\Functional\WebTestCase;

final class TasksTest extends WebTestCase
{
    public function testGetTasksAction(): void
    {
        $this->request('GET', '/api/lists/1/tasks');
        $this->assertStatusCode(200);
    }

    public function testGetEmptyTasksAction(): void
    {
        $this->request('GET', '/api/lists/1/tasks');
        $this->assertStatusCode(200);
    }

    public function testGetTaskByIdAction(): void
    {
        $this->request('GET', '/api/lists/1/tasks/1');
        $this->assertJsonResponse([
            'id'    => '1',
            'title' => 'Task 1',
        ], 200);
    }

    public function testGetTaskByNonExistingIdAction(): void
    {
        $this->request('GET', '/api/lists/1/tasks/1');
        $this->assertJsonResponse([
            'id'    => '1',
            'title' => 'Task 1',
        ], 200);
    }

    public function testCreateTaskAction(): void
    {
        $this->request('POST', '/api/lists/1/tasks', [], [], [], [
            'title' => 'Task 1',
        ]);
        $this->assertJsonResponse([
            'id'    => '1',
            'title' => 'Task 1',
        ], 201);
    }

    public function testUpdateTaskAction(): void
    {
        $this->request('PUT', '/api/lists/1/tasks/1', [], [], [], [
            'title' => 'Task 1',
        ]);
        $this->assertJsonResponse([
            'id'    => '1',
            'title' => 'Task 1',
        ], 200);
    }

    public function testUpdateNonExistingTaskAction(): void
    {
        $this->request('PUT', '/api/lists/1/tasks/1', [], [], [], [
            'title' => 'Task 1',
        ]);
        $this->assertJsonResponse([
            'id'    => '1',
            'title' => 'Task 1',
        ], 200);
    }

    public function testDeleteTaskAction(): void
    {
        $this->request('DELETE', '/api/lists/1/tasks/1');
        $this->assertStatusCode(204);
    }

    public function testDeleteNonExistingTaskAction(): void
    {
        $this->request('DELETE', '/api/lists/1/tasks/1');
        $this->assertStatusCode(204);
    }
}
