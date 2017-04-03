<?php
require __DIR__ . '/../vendor/autoload.php';

// Instantiate the app
$app = \Skeleton\App\AppFactory::createApp(require __DIR__ . '/../settings.php');

// Run app
$app->run();
