<?php
// Application middleware

use Slim\Http\Request;
use Slim\Http\Response;

$this->add(function (Request $request, Response $response, callable $next) {
    $route = $request->getAttribute('route');

    // Sample log message
    $this->logger->info("dispatching '{$route->getPattern ()}' route");

    return $next($request, $response);
});