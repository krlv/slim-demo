<?php
// DIC configuration

$container = $app->getContainer();

// view renderer
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// doctrine connection
$container['db'] = function ($c) {
    $settings = $c->get('settings')['db'];
    return Doctrine\DBAL\DriverManager::getConnection($settings);
};

// redis client
$container['redis'] = function ($c) {
    $settings = $c->get('settings')['redis'];
    return new Predis\Client($settings);
};

// ElasticSearch client
$container['search'] = function ($c) {
    $settings = $c->get('settings')['search'];
    return new Elastica\Client($settings);
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], Monolog\Logger::DEBUG));
    return $logger;
};
