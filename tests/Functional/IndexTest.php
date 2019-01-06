<?php
declare(strict_types=1);

namespace Skeleton\Test\Functional;

class IndexTest extends WebTestCase
{
    public function testIndexAction()
    {
        $this->client->request('GET', '/');
        $this->assertStatusCode(200);
        $this->assertContains('SlimFramework', $this->client->getResponse());
    }

    public function testIndexActionWithName()
    {
        $this->client->request('GET', '/Eugene');
        $this->assertStatusCode(200);
        $this->assertContains('Eugene', $this->client->getResponse());
    }

    public function testIndexActionNotAllowed()
    {
        $this->client->request('POST', '/Eugene');
        $this->assertStatusCode(405);
        $this->assertContains('Method not allowed', $this->client->getResponse());
    }
}
