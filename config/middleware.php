<?php

declare(strict_types=1);

use Demo\Application\Middleware;
use Slim\App;

return static function (App $app) {
    $app->add(Middleware\LoggerMiddleware::class);
    $app->addMiddleware(new Middlewares\TrailingSlash(false));
    $app->addMiddleware(new Middlewares\JsonPayload());
};
