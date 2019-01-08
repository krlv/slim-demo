<?php

declare(strict_types=1);

namespace Skeleton\Test\Unit\App\Serializer;

use JMS\Serializer\SerializerInterface;
use PHPUnit\Framework\TestCase;
use Skeleton\App\Serializer\Serializer;
use Slim\Http\Request;
use Slim\Http\RequestBody;
use Slim\Http\Response;

class SerializerTest extends TestCase
{
    public function testSerialize(): void
    {
        $task = ['id' => 1, 'title' => 'Task 1'];
        $data = '{"id":1,"title":"Task 1"}';

        $serializer = $this
            ->getMockBuilder(SerializerInterface::class)
            ->setMethods(['serialize'])
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

        $response = $this
            ->getMockBuilder(Response::class)
            ->disableOriginalConstructor()
            ->setMethods(['withHeader', 'withStatus', 'write'])
            ->getMock()
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
            ->method('write')
            ->with($this->equalTo($data))
            ->willReturn($response)
        ;

        /** @var SerializerInterface $serializer */
        $appSerializer = new Serializer($serializer);
        // @var Response $response
        $this->assertSame($response, $appSerializer->serialize($response, $task, $status));
    }

    public function testDeserialize(): void
    {
        $task = ['id' => 1, 'title' => 'Task 1'];

        $requestBody = new RequestBody();
        $requestBody->write($jsonString = '{"id":1,"title":"Task 1"}');

        // Request mock with body
        $request = $this
            ->getMockBuilder(Request::class)
            ->disableOriginalConstructor()
            ->setMethods(['getBody'])
            ->getMock()
        ;

        $request
            ->expects($this->once())
            ->method('getBody')
            ->willReturn($requestBody)
        ;

        // Serializer mock with deserialize method
        $serializer = $this
            ->getMockBuilder(SerializerInterface::class)
            ->setMethods(['deserialize'])
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

        /** @var SerializerInterface $serializer */
        $appSerializer = new Serializer($serializer);
        // @var Request $request
        $this->assertSame($task, $appSerializer->deserialize($request, $class));
    }
}
