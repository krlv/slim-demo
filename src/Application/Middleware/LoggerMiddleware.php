<?php

declare(strict_types=1);

namespace Demo\Application\Middleware;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Psr\Log\LoggerInterface;
use Slim\Routing\RouteContext;

final class LoggerMiddleware implements MiddlewareInterface
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function process(Request $request, RequestHandler $handler): Response
    {
        $route = $request->getAttribute(RouteContext::ROUTE);

        // Sample log message
        $this->logger->info(\sprintf("dispatching '%s' route", $route->getPattern()));

        return $handler->handle($request);
    }
}
