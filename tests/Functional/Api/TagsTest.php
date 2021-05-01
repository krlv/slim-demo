<?php

declare(strict_types=1);

namespace Demo\Test\Functional\Api;

use Demo\Test\Functional\WebTestCase;

final class TagsTest extends WebTestCase
{
    public function testGetTagsAction(): void
    {
        $this->request('GET', '/api/tags', ['Content-Type' => 'application/json']);
        $this->assertStatusCode(200);
    }

    public function testGetEmptyTagsAction(): void
    {
        $this->request('GET', '/api/tags', ['Content-Type' => 'application/json']);
        $this->assertStatusCode(200);
    }

    public function testCreateListAction(): void
    {
        $this->request('POST', '/api/tags', [
            'Content-Type' => 'application/json',
        ], [], [], [
            'title' => 'Tag 1',
        ]);
        $this->assertJsonResponse([
            'id'    => 1,
            'title' => 'Tag 1',
        ], 201);
    }
}
