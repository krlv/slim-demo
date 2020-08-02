<?php

declare(strict_types=1);

namespace Skeleton\App\Middleware;

use Monolog\Logger;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class LoggerMiddleware implements MiddlewareInterface
{
    /**
     * @var Logger
     */
    private $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $route = $request->getAttribute('route');

        // Sample log message
        $this->logger->info(\sprintf("dispatching '%s' route", $route->getPattern()));

        return $handler->handle($request);
    }
}
