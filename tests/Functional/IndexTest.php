<?php

declare(strict_types=1);

namespace Demo\Test\Functional;

class IndexTest extends WebTestCase
{
    public function testIndexAction(): void
    {
        $this->request('GET', '/');
        $this->assertStatusCode(200);
        $this->assertStringContainsString('SlimFramework', (string) $this->response->getBody());
    }

    public function testIndexActionWithName(): void
    {
        $this->request('GET', '/Eugene');
        $this->assertStatusCode(200);
        $this->assertStringContainsString('Eugene', (string) $this->response->getBody());
    }

    public function testIndexActionNotAllowed(): void
    {
        $this->request('POST', '/Eugene');
        $this->assertStatusCode(405);
        $this->assertStringContainsString('Method not allowed', (string) $this->response->getBody());
    }
}
