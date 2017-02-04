<?php
use Interop\Container\ContainerInterface;

// DIC configuration
$container = $this->getContainer();

// view renderer
$container['renderer'] = function (ContainerInterface $c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// doctrine connection
$container['db'] = function (ContainerInterface $c) {
    $settings = $c->get('settings')['db'];
    return Doctrine\DBAL\DriverManager::getConnection($settings);
};

// monolog
$container['logger'] = function (ContainerInterface $c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], Monolog\Logger::DEBUG));
    return $logger;
};
