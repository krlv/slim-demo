<?php
declare(strict_types=1);

namespace Skeleton\App\Provider;

use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\Visitor\Factory\JsonDeserializationVisitorFactory;
use JMS\Serializer\Visitor\Factory\JsonSerializationVisitorFactory;
use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Skeleton\App\Serializer\Serializer;

class SerializerServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        $pimple['serializer'] = function (\Slim\Container $c) {
            $serializer = SerializerBuilder::create()
                ->setSerializationVisitor('json', new JsonSerializationVisitorFactory())
                ->setDeserializationVisitor('json', new JsonDeserializationVisitorFactory())
                ->build();

            return new Serializer($serializer);
        };
    }
}
