<?php

declare(strict_types=1);

use Middlewares\TrailingSlash;
use Skeleton\App\Middleware\JsonBodyParserMiddleware;
use Slim\App;

return static function (App $app) {
    $app->add('logger_middleware:process');
    $app->addMiddleware(new TrailingSlash(false));
    $app->addMiddleware(new JsonBodyParserMiddleware());
};
