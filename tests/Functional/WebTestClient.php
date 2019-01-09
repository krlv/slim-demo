<?php

declare(strict_types=1);

namespace Skeleton\Test\Functional;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\App;
use Slim\Exception\MethodNotAllowedException;
use Slim\Exception\NotFoundException;
use Slim\Http;

/**
 * WebTestClient simulates web browser and makes requests to application.
 */
class WebTestClient
{
    /**
     * @var App
     */
    protected $app;

    /**
     * @var string[]
     */
    protected $server;

    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * @var ResponseInterface
     */
    protected $response;

    /**
     * @param App      $app
     * @param string[] $server
     */
    public function __construct(App $app, array $server)
    {
        $this->app = $app;

        $this->server = \array_merge([
            'SCRIPT_NAME' => '/index.php',
        ], $server);
    }

    /**
     * Perform request.
     *
     * @param string   $method
     * @param string   $uri
     * @param string[] $params
     * @param string[] $server
     * @param string[] $content
     *
     * @throws MethodNotAllowedException
     * @throws NotFoundException
     */
    public function request(string $method, string $uri, array $params = [], array $server = [], array $content = []): void
    {
        $method = \strtoupper($method);
        switch ($method) {
            case 'POST':
            case 'PUT':
            case 'PATCH':
            case 'DELETE':
                $this->server['slim.input'] = \http_build_query($params);
                $query                      = '';
                break;

            case 'GET':
            default:
                $query = \http_build_query($params);
                break;
        }

        $server = \array_merge($this->server, $server, [
            'REQUEST_URI'    => $uri,
            'REQUEST_METHOD' => $method,
            'QUERY_STRING'   => $query,
        ]);
        $env = Http\Environment::mock($server);

        $request = Http\Request::createFromEnvironment($env);
        if (!empty($content)) {
            $request = $request->withParsedBody($content);
        }

        $response = new Http\Response();
        $response = $this->app->__invoke($request, $response);

        $this->request  = $request;
        $this->response = $response;
    }

    /**
     * Returns response status code.
     *
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->response->getStatusCode();
    }

    /**
     * Returns response headers.
     *
     * @return array[string[]]
     */
    public function getHeaders(): array
    {
        return $this->response->getHeaders();
    }

    /**
     * Returns response header by name.
     *
     * @param string $name
     *
     * @return string[]
     */
    public function getHeader(string $name): array
    {
        return $this->response->getHeader($name);
    }

    /**
     * Returns response body as a string.
     *
     * @return string
     */
    public function getResponse(): string
    {
        return (string) $this->response->getBody();
    }
}
