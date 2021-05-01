<?php

declare(strict_types=1);

namespace Demo\Application\Serializer;

use Fig\Http\Message\StatusCodeInterface as HttpCode;
use JMS\Serializer\SerializerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class Serializer
{
    private SerializerInterface $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * Serializes data in the request object.
     *
     * @param mixed|object $data
     */
    public function serialize(Response $response, $data, int $status = HttpCode::STATUS_OK): Response
    {
        $data = $this->serializer->serialize($data, 'json');

        $body = $response->getBody();
        $body->write($data);

        return $response
            ->withHeader('Content-Type', 'application/json;charset=utf-8')
            ->withStatus($status)
            ->withBody($body)
        ;
    }

    /**
     * Deserializes data into the entity object.
     *
     * @return array|object
     */
    public function deserialize(Request $request, string $class)
    {
        return $this->serializer->deserialize((string) $request->getBody(), $class, 'json');
    }
}
