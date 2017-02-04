<?php
require __DIR__ . '/../vendor/autoload.php';

session_start();

// Instantiate the app
$app = \Skeleton\App\AppFactory::createApp(require __DIR__ . '/../src/settings.php');

// Run app
$app->run();
