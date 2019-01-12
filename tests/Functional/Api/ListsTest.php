<?php

declare(strict_types=1);

namespace Skeleton\Test\Functional\Api;

use Skeleton\Test\Functional\WebTestCase;

final class ListsTest extends WebTestCase
{
    public function testGetListsAction(): void
    {
        $this->client->request('GET', '/api/lists');
        $this->assertStatusCode(200);
    }

    public function testGetEmptyListsAction(): void
    {
        $this->client->request('GET', '/api/lists');
        $this->assertStatusCode(200);
    }

    public function testGetListByIdAction(): void
    {
        $this->client->request('GET', '/api/lists/1');
        $this->assertJsonResponse([
            'id'    => '1',
            'title' => 'Task List 1',
        ], 200);
    }

    public function testGetListByNonExistingIdAction(): void
    {
        $this->client->request('GET', '/api/lists/1');
        $this->assertJsonResponse([
            'id'    => '1',
            'title' => 'Task List 1',
        ], 200);
    }

    public function testCreateListAction(): void
    {
        $this->client->request('POST', '/api/lists', [], [], [
            'title' => 'Task List 1',
        ]);
        $this->assertJsonResponse([
            'id'    => '1',
            'title' => 'Task List 1',
        ], 201);
    }

    public function testUpdateListAction(): void
    {
        $this->client->request('PUT', '/api/lists/1', [], [], [
            'title' => 'Task List 1',
        ]);
        $this->assertJsonResponse([
            'id'    => '1',
            'title' => 'Task List 1',
        ], 200);
    }

    public function testUpdateNonExistingListAction(): void
    {
        $this->client->request('PUT', '/api/lists/1', [], [], [
            'title' => 'Task List 1',
        ]);
        $this->assertJsonResponse([
            'id'    => '1',
            'title' => 'Task List 1',
        ], 200);
    }

    public function testDeleteListAction(): void
    {
        $this->client->request('DELETE', '/api/lists/1');
        $this->assertStatusCode(204);
    }

    public function testDeleteNonExistingListAction(): void
    {
        $this->client->request('DELETE', '/api/lists/1');
        $this->assertStatusCode(204);
    }
}
