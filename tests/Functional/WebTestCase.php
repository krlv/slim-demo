<?php

declare(strict_types=1);

namespace Skeleton\Test\Functional;

use PHPUnit\Framework\TestCase;
use Skeleton\App\AppFactory;
use Skeleton\App\SkeletonApp;

/**
 * Base class functional tests.
 */
class WebTestCase extends TestCase
{
    /**
     * Application instance.
     *
     * @var SkeletonApp
     */
    protected $app;

    /**
     * @var WebTestClient
     */
    protected $client;

    /**
     * Setting up test environment.
     */
    public static function setUpBeforeClass(): void
    {
        //TODO: init database
    }

    /**
     * Setting up the application.
     */
    protected function setUp(): void
    {
        $this->app = $this->createApplication();
        //TODO: init database tables
        $this->client = $this->createClient();
    }

    /**
     * Creates the application.
     *
     * @return SkeletonApp
     */
    public function createApplication(): SkeletonApp
    {
        return AppFactory::createTestApp(require __DIR__ . '/../../settings.php');
    }

    /**
     * Creates a Client.
     *
     * @param string[] $server Server parameters
     *
     * @return WebTestClient A Client instance
     */
    public function createClient(array $server = [])
    {
        return new WebTestClient($this->app, $server);
    }

    /**
     * Assert that response status equals to expected code.
     *
     * @param int $code
     */
    public function assertStatusCode(int $code): void
    {
        $this->assertEquals($code, $this->client->getStatusCode());
    }

    /**
     * Assert that response content type equals to expected content type.
     *
     * @param string $type
     */
    public function assertContentType(string $type): void
    {
        $this->assertContains($type, $this->client->getHeader('Content-Type'));
    }

    /**
     * Assert that JSON response equals to expected data.
     *
     * @param string[] $expected
     * @param int      $code
     */
    public function assertJsonResponse(array $expected, $code = 200): void
    {
        $this->assertStatusCode($code);
        $this->assertContentType('application/json;charset=utf-8');

        $expected = \json_encode($expected);
        $actual   = $this->client->getResponse();
        $this->assertEquals($expected, $actual);
    }
}
