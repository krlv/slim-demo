<?php
return [
    'settings' => [
        'displayErrorDetails'               => true,
        'determineRouteBeforeAppMiddleware' => true,

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/templates/',
        ],

        // Database settings
        'dbal' => [
            'dbname'   => 'skeleton',
            'user'     => 'homestead',
            'password' => 'secret',
            'host'     => '127.0.0.1',
            'driver'   => 'pdo_mysql',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'skeleton-app',
            'path' => __DIR__ . '/var/logs/app.log',
        ],
    ],
];
