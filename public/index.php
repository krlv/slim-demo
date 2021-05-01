<?php
require __DIR__ . '/../vendor/autoload.php';

// Instantiate the app
$app = \Demo\Application\AppFactory::createApp();

// Run app
$app->run();
