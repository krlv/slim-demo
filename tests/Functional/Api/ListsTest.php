<?php

declare(strict_types=1);

namespace Skeleton\Test\Functional\Api;

use Skeleton\Test\Functional\WebTestCase;

final class ListsTest extends WebTestCase
{
    public function testGetListsAction(): void
    {
        $this->request('GET', '/api/lists', ['Content-Type' => 'application/json']);
        $this->assertStatusCode(200);
    }

    public function testGetEmptyListsAction(): void
    {
        $this->request('GET', '/api/lists', ['Content-Type' => 'application/json']);
        $this->assertStatusCode(200);
    }

    public function testGetListByIdAction(): void
    {
        $this->request('GET', '/api/lists/1', ['Content-Type' => 'application/json']);
        $this->assertJsonResponse([
            'id'    => 1,
            'title' => 'Task List 1',
        ], 200);
    }

    public function testGetListByNonExistingIdAction(): void
    {
        $this->request('GET', '/api/lists/1', ['Content-Type' => 'application/json']);
        $this->assertJsonResponse([
            'id'    => 1,
            'title' => 'Task List 1',
        ], 200);
    }

    public function testCreateListAction(): void
    {
        $this->request('POST', '/api/lists', [
            'Content-Type' => 'application/json',
        ], [], [], [
            'title' => 'Task List 1',
        ]);
        $this->assertJsonResponse([
            'id'    => 1,
            'title' => 'Task List 1',
        ], 201);
    }

    public function testUpdateListAction(): void
    {
        $this->request('PUT', '/api/lists/1', [
            'Content-Type' => 'application/json',
        ], [], [], [
            'title' => 'Task List 1',
        ]);
        $this->assertJsonResponse([
            'id'    => 1,
            'title' => 'Task List 1',
        ], 200);
    }

    public function testUpdateNonExistingListAction(): void
    {
        $this->request('PUT', '/api/lists/1', [
            'Content-Type' => 'application/json',
        ], [], [], [
            'title' => 'Task List 1',
        ]);
        $this->assertJsonResponse([
            'id'    => 1,
            'title' => 'Task List 1',
        ], 200);
    }

    public function testDeleteListAction(): void
    {
        $this->request('DELETE', '/api/lists/1', ['Content-Type' => 'application/json']);
        $this->assertStatusCode(204);
    }

    public function testDeleteNonExistingListAction(): void
    {
        $this->request('DELETE', '/api/lists/1', ['Content-Type' => 'application/json']);
        $this->assertStatusCode(204);
    }
}
