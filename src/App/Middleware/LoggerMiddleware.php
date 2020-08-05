<?php

declare(strict_types=1);

namespace Skeleton\App\Middleware;

use Monolog\Logger;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Routing\RouteContext;

final class LoggerMiddleware implements MiddlewareInterface
{
    /**
     * @var Logger
     */
    private $logger;

    public function __construct(Logger $logger)
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
