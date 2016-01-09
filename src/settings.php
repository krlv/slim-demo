<?php
return [
    'settings' => [
        'displayErrorDetails' => true,
        'determineRouteBeforeAppMiddleware' => true,

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        // Database settings
        'db' => [
            'dbname'   => 'skeleton',
            'user'     => 'homestead',
            'password' => 'secret',
            'host'     => '127.0.0.1',
            'driver'   => 'pdo_mysql',
        ],

        // Redis settings
        'redis' => [
            'scheme' => 'tcp',
            'host'   => '127.0.0.1',
            'port'   => 6379
        ],

        // ElasticSearch settings
        'search' => [
            'host'   => '10.10.10.12',
            'port'   => 9200
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => __DIR__ . '/../logs/app.log',
        ],
    ],
];
