<?php

declare(strict_types=1);

namespace Skeleton\Test\Functional;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface as Response;
use Skeleton\App\AppFactory;
use Slim\App as SlimApp;
use Slim\Psr7\Factory\StreamFactory;
use Slim\Psr7\Headers;
use Slim\Psr7\Request;
use Slim\Psr7\Uri;

/**
 * Base class functional tests.
 */
class WebTestCase extends TestCase
{
    /**
     * Application instance.
     *
     * @var SlimApp
     */
    protected $app;

    /**
     * @var Response
     */
    protected $response;

    /**
     * Setting up test environment.
     */
    public static function setUpBeforeClass(): void
    {
        //TODO: init database state
    }

    /**
     * Setting up the application.
     */
    protected function setUp(): void
    {
        $this->app = AppFactory::createApp(true);

        //TODO: init database tables
    }

    public function request(
        string $method,
        string $path,
        array $headers = [],
        array $cookies = [],
        array $server = [],
        array $content = []
    ): void {
        $uri = new Uri('', '', 80, $path);

        $stream = (new StreamFactory())->createStream();

        $h = new Headers();
        foreach ($headers as $name => $value) {
            $h->addHeader($name, $value);
        }

        $request = new Request($method, $uri, $h, $cookies, $server, $stream);
        if (!empty($content)) {
            $request = $request->withParsedBody($content);
        }

        $this->response = $this->app->handle($request);
    }

    /**
     * Assert that response status equals to expected code.
     */
    public function assertStatusCode(int $code): void
    {
        $this->assertEquals($code, $this->response->getStatusCode());
    }

    /**
     * Assert that response content type equals to expected content type.
     */
    public function assertContentType(string $type): void
    {
        $this->assertContains($type, $this->response->getHeader('Content-Type'));
    }

    /**
     * Assert that JSON response equals to expected data.
     *
     * @param string[] $expected
     */
    public function assertJsonResponse(array $expected, int $code = 200): void
    {
        $this->assertStatusCode($code);
        $this->assertContentType('application/json;charset=utf-8');

        $expected = \json_encode($expected);
        $actual   = (string) $this->response->getBody();

        $this->assertEquals($expected, $actual);
    }
}
