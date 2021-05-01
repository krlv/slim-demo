<?php

declare(strict_types=1);

use DI\ContainerBuilder;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        'settings' => [
            // Slim settings
            'displayErrorDetails'               => true,
            'determineRouteBeforeAppMiddleware' => true,

            // Renderer settings
            'renderer' => [
                'template_path' => __DIR__ . '/../templates/',
            ],

            // Database settings
            // TODO: use env to set db host, user and password values
            'dbal' => [
                'dbname'   => 'demo',
                'user'     => 'root',
                'password' => 'secret',
                'host'     => '127.0.0.1',
                'driver'   => 'pdo_mysql',
            ],

            // Monolog settings
            'logger' => [
                'name' => 'slim-demo',
                'path' => __DIR__ . '/../var/log/app.log',
            ],
        ],
    ]);
};
