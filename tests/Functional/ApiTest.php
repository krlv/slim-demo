<?php
namespace Skeleton\Test\Functional;

class ApiTest extends WebTestCase
{
    public function testGetTasksListAction()
    {
        $this->client->request('GET', '/api/tasks');
        $this->assertStatusCode(200);
    }

    public function testGetEmptyTasksListAction()
    {
        $this->client->request('GET', '/api/tasks');
        $this->assertStatusCode(200);
    }

    public function testGetTaskByIdAction()
    {
        $this->client->request('GET', '/api/tasks/1');
        $this->assertJsonResponse([
            'id'    => '1',
            'title' => 'Task 1',
        ], 200);
    }

    public function testGetTaskByNonExistingIdAction()
    {
        $this->client->request('GET', '/api/tasks/1');
        $this->assertJsonResponse([
            'id'    => '1',
            'title' => 'Task 1',
        ], 200);
    }

    public function testCreateTaskAction()
    {
        $this->client->request('POST', '/api/tasks', [], [], [
            'title' => 'Task 1'
        ]);
        $this->assertJsonResponse([
            'id'    => '1',
            'title' => 'Task 1',
        ], 201);
    }

    public function testUpdateTaskAction()
    {
        $this->client->request('PUT', '/api/tasks/1', [], [], [
            'title' => 'Task 1'
        ]);
        $this->assertJsonResponse([
            'id'    => '1',
            'title' => 'Task 1',
        ], 200);
    }

    public function testUpdateNonExistingTaskAction()
    {
        $this->client->request('PUT', '/api/tasks/1', [], [], [
            'title' => 'Task 1'
        ]);
        $this->assertJsonResponse([
            'id'    => '1',
            'title' => 'Task 1',
        ], 200);
    }

    public function testDeleteTaskAction()
    {
        $this->client->request('DELETE', '/api/tasks/1');
        $this->assertStatusCode(204);
    }

    public function testDeleteNonExistingTaskAction()
    {
        $this->client->request('DELETE', '/api/tasks/1');
        $this->assertStatusCode(204);
    }
}