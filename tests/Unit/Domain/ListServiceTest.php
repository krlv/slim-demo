<?php

declare(strict_types=1);

namespace Skeleton\Test\Unit\Domain;

use PHPUnit\Framework\TestCase;
use Skeleton\Domain\ListEnity;
use Skeleton\Domain\ListRepository;
use Skeleton\Domain\ListService;

final class ListServiceTest extends TestCase
{
    public function testGetLists(): void
    {
        $lists = [
            new ListEnity('Task List 1'),
            new ListEnity('Task List 2'),
        ];

        // Repository mock
        $repository = $this
            ->getMockBuilder(ListRepository::class)
            ->onlyMethods(['find'])
            ->getMockForAbstractClass()
        ;

        $repository
            ->expects($this->once())
            ->method('find')
            ->willReturn($lists)
        ;

        $service = new ListService($repository);
        $this->assertSame($lists, $service->getLists());
    }

    public function testGetListById(): void
    {
        $list = new ListEnity('Task List 1');

        // Repository mock
        $repository = $this
            ->getMockBuilder(ListRepository::class)
            ->onlyMethods(['findById'])
            ->getMockForAbstractClass()
        ;

        $repository
            ->expects($this->once())
            ->method('findById')
            ->with($this->equalTo($id = 1))
            ->willReturn($list)
        ;

        $service = new ListService($repository);
        $this->assertSame($list, $service->getListById($id));
    }

    public function testCreateList(): void
    {
        $data = ['title' => 'New Task List'];
        $list = new ListEnity('New Task List');

        // Repository mock
        $repository = $this
            ->getMockBuilder(ListRepository::class)
            ->onlyMethods(['store'])
            ->getMockForAbstractClass()
        ;

        $repository
            ->expects($this->once())
            ->method('store')
            ->with($this->equalTo($list))
            ->willReturn($list)
        ;

        $service = new ListService($repository);
        $this->assertSame($list, $service->createList($data));
    }

    public function testUpdateList(): void
    {
        $data = ['title' => 'New Task List'];
        $list = new ListEnity('Old Task List');

        // Repository mock
        $repository = $this
            ->getMockBuilder(ListRepository::class)
            ->onlyMethods(['findById', 'store'])
            ->getMockForAbstractClass()
        ;

        $repository
            ->expects($this->once())
            ->method('findById')
            ->with($this->equalTo($id = 1))
            ->willReturn($list)
        ;

        $list->setTitle('New Task List');

        $repository
            ->expects($this->once())
            ->method('store')
            ->with($this->equalTo($list))
            ->willReturn($list)
        ;

        $service = new ListService($repository);
        $this->assertSame($list, $service->updateList($id, $data));
    }

    public function testDeleteList(): void
    {
        $list = new ListEnity('Task List 1');

        // Repository mock
        $repository = $this
            ->getMockBuilder(ListRepository::class)
            ->onlyMethods(['findById', 'store'])
            ->getMockForAbstractClass()
        ;

        $repository
            ->expects($this->once())
            ->method('findById')
            ->with($this->equalTo($id = 1))
            ->willReturn($list)
        ;

        $list->delete();

        $repository
            ->expects($this->once())
            ->method('store')
            ->with($this->equalTo($list))
            ->willReturn($list)
        ;

        $service = new ListService($repository);
        $service->deleteList($id);
    }
}
