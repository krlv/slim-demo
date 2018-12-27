<?php
namespace Skeleton\App\Provider;

use JMS\Serializer\SerializerBuilder;
use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Skeleton\App\Serializer\Serializer;

class SerializerServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        $pimple['serializer'] = function (\Slim\Container $c) {
            $serializer = SerializerBuilder::create()->build();
            return new Serializer($serializer);
        };
    }
}