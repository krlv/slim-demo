<?php

declare(strict_types=1);

namespace Skeleton\Test\Unit\App\Serializer;

use JMS\Serializer\SerializerInterface;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\StreamInterface;
use Skeleton\App\Serializer\Serializer;

class SerializerTest extends TestCase
{
    public function testSerialize(): void
    {
        $task = ['id' => 1, 'title' => 'Task 1'];
        $data = '{"id":1,"title":"Task 1"}';

        $serializer = $this
            ->getMockBuilder(SerializerInterface::class)
            ->onlyMethods(['serialize'])
            ->getMockForAbstractClass()
        ;

        $serializer
            ->expects($this->once())
            ->method('serialize')
            ->with(
                $this->equalTo($task),
                $this->equalTo('json')
            )
            ->willReturn($data)
        ;

        $responseBody = $this
            ->getMockBuilder(StreamInterface::class)
            ->onlyMethods(['write'])
            ->getMockForAbstractClass()
        ;

        $responseBody
            ->expects($this->once())
            ->method('write')
            ->with($data)
            ->willReturn(\strlen($data))
        ;

        $response = $this
            ->getMockBuilder(Response::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getBody', 'withHeader', 'withStatus', 'withBody'])
            ->getMockForAbstractClass()
        ;

        $response
            ->expects($this->once())
            ->method('getBody')
            ->willReturn($responseBody)
        ;

        $response
            ->expects($this->once())
            ->method('withHeader')
            ->with(
                $this->equalTo('Content-Type'),
                $this->equalTo('application/json;charset=utf-8')
            )
            ->willReturn($response)
        ;

        $response
            ->expects($this->once())
            ->method('withStatus')
            ->with($this->equalTo($status = 201))
            ->willReturn($response)
        ;

        $response
            ->expects($this->once())
            ->method('withBody')
            ->with($this->equalTo($responseBody))
            ->willReturn($response)
        ;

        $appSerializer = new Serializer($serializer);
        // @var Response $response
        $this->assertSame($response, $appSerializer->serialize($response, $task, $status));
    }

    public function testDeserialize(): void
    {
        $task = ['id' => 1, 'title' => 'Task 1'];

        $requestBody = $this
            ->getMockBuilder(StreamInterface::class)
            ->onlyMethods(['__toString'])
            ->getMockForAbstractClass()
        ;

        $requestBody
            ->expects($this->once())
            ->method('__toString')
            ->willReturn($jsonString = '{"id":1,"title":"Task 1"}')
        ;

        // Request mock with body
        $request = $this
            ->getMockBuilder(Request::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getBody'])
            ->getMockForAbstractClass()
        ;

        $request
            ->expects($this->once())
            ->method('getBody')
            ->willReturn($requestBody)
        ;

        // Serializer mock with deserialize method
        $serializer = $this
            ->getMockBuilder(SerializerInterface::class)
            ->onlyMethods(['deserialize'])
            ->getMockForAbstractClass()
        ;

        $serializer
            ->expects($this->once())
            ->method('deserialize')
            ->with(
                $this->equalTo($jsonString),
                $this->equalTo($class = \stdClass::class),
                $this->equalTo('json')
            )
            ->willReturn($task)
        ;

        $appSerializer = new Serializer($serializer);
        // @var Request $request
        $this->assertSame($task, $appSerializer->deserialize($request, $class));
    }
}
