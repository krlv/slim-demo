<?php

declare(strict_types=1);

use DI\ContainerBuilder;
use Doctrine\DBAL\Driver\Connection;
use Doctrine\DBAL\DriverManager;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\Visitor\Factory\JsonDeserializationVisitorFactory;
use JMS\Serializer\Visitor\Factory\JsonSerializationVisitorFactory;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Demo\Application\Serializer\Serializer;
use Demo\Domain\TagRepository;
use Demo\Domain\ListRepository;
use Demo\Domain\TaskRepository;
use Demo\Infrastructure\Persistence\MemoryTagRepository;
use Demo\Infrastructure\Persistence\MemoryListRepository;
use Demo\Infrastructure\Persistence\MemoryTaskRepository;
use Slim\Views\PhpRenderer;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        LoggerInterface::class => function (ContainerInterface $c) {
            $settings = $c->get('settings')['logger'];

            $logger = new Logger($settings['name']);
            $logger->pushProcessor(new UidProcessor());
            $logger->pushHandler(new StreamHandler($settings['path'], Logger::DEBUG));

            return $logger;
        },

        PhpRenderer::class => function (ContainerInterface $c) {
            $settings = $c->get('settings')['renderer'];
            return new PhpRenderer($settings['template_path']);
        },

        Serializer::class => function (ContainerInterface $c) {
            $serializer = SerializerBuilder::create()
                ->setSerializationVisitor('json', new JsonSerializationVisitorFactory())
                ->setDeserializationVisitor('json', new JsonDeserializationVisitorFactory())
                ->build();

            return new Serializer($serializer);
        },

        Connection::class => function (ContainerInterface $c) {
            $settings = $c->get('settings')['dbal'];
            return DriverManager::getConnection($settings);
        },

        TagRepository::class => DI\autowire(MemoryTagRepository::class),
        TaskRepository::class => DI\autowire(MemoryTaskRepository::class),
        ListRepository::class => DI\autowire(MemoryListRepository::class),
    ]);
};
