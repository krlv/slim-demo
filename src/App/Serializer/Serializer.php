<?php

declare(strict_types=1);

namespace Skeleton\App\Serializer;

use JMS\Serializer\SerializerInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\StatusCode;

class Serializer
{
    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @param SerializerInterface $serializer
     */
    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * Serializes data in the request object.
     *
     * @param Response     $response
     * @param mixed|object $data
     * @param int          $status
     *
     * @return Response
     */
    public function serialize(Response $response, $data, int $status = StatusCode::HTTP_OK): Response
    {
        $data = $this->serializer->serialize($data, 'json');

        return $response
            ->withHeader('Content-Type', 'application/json;charset=utf-8')
            ->withStatus($status)
            ->write($data)
        ;
    }

    /**
     * Deserializes data into the entity object.
     *
     * @param Request $request
     * @param string  $class
     *
     * @return object
     */
    public function deserialize(Request $request, string $class)
    {
        return $this->serializer->deserialize((string) $request->getBody(), $class, 'json');
    }
}
