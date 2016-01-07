<?php
return [
    'settings' => [
        'displayErrorDetails' => true,

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

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => __DIR__ . '/../logs/app.log',
        ],
    ],
];
