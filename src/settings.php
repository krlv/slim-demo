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

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => __DIR__ . '/../logs/app.log',
        ],
    ],
];
