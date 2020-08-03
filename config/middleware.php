<?php

declare(strict_types=1);

use Middlewares\TrailingSlash;
use Skeleton\App\Middleware;
use Slim\App;

return static function (App $app) {
    $app->add(Middleware\LoggerMiddleware::class);
    $app->addMiddleware(new TrailingSlash(false));
    $app->addMiddleware(new Middleware\JsonBodyParserMiddleware());
};
