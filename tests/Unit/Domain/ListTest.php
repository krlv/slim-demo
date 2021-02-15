<?php

declare(strict_types=1);

namespace Skeleton\Test\Unit\Domain;

use PHPUnit\Framework\TestCase;
use Skeleton\Domain\ListEnity;
use Skeleton\Test\Unit\Traits\Visibility;

class ListTest extends TestCase
{
    use Visibility;

    public function testConstructor(): void
    {
        $list = new ListEnity($title = 'Task List');
        $this->assertSame($title, $list->getTitle());
    }

    public function testId(): void
    {
        $id   = 1;
        $list = new ListEnity('Task List');

        $this->setPrivateProperty($list, 'id', $id);
        $this->assertEquals($id, $list->getId());
    }

    public function testTitle(): void
    {
        $list = new ListEnity('Task List');
        $list->setTitle($title = 'New List');
        $this->assertEquals($title, $list->getTitle());
    }
}
