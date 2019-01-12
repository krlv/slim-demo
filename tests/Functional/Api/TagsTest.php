<?php

declare(strict_types=1);

namespace Skeleton\Test\Functional\Api;

use Skeleton\Test\Functional\WebTestCase;

final class TagsTest extends WebTestCase
{
    public function testGetTagsAction(): void
    {
        $this->client->request('GET', '/api/tags');
        $this->assertStatusCode(200);
    }

    public function testGetEmptyTagsAction(): void
    {
        $this->client->request('GET', '/api/tags');
        $this->assertStatusCode(200);
    }

    public function testGetTagByIdAction(): void
    {
        $this->client->request('GET', '/api/tags/1');
        $this->assertJsonResponse([
            'id'    => '1',
            'title' => 'Tag 1',
        ], 200);
    }

    public function testGetListByNonExistingIdAction(): void
    {
        $this->client->request('GET', '/api/tags/1');
        $this->assertJsonResponse([
            'id'    => '1',
            'title' => 'Tag 1',
        ], 200);
    }

    public function testCreateListAction(): void
    {
        $this->client->request('POST', '/api/tags', [], [], [
            'title' => 'Tag 1',
        ]);
        $this->assertJsonResponse([
            'id'    => '1',
            'title' => 'Tag 1',
        ], 201);
    }
}
