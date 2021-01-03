<?php

declare(strict_types=1);

namespace Skeleton\Test\Unit\Domain;

use PHPUnit\Framework\TestCase;
use Skeleton\Domain\TaskList;
use Skeleton\Test\Unit\Traits\Visibility;

class TaskListTest extends TestCase
{
    use Visibility;

    public function testConstructor(): void
    {
        $list = new TaskList($title = 'Task List');
        $this->assertSame($title, $list->getTitle());
    }

    public function testId(): void
    {
        $id   = 1;
        $list = new TaskList('Task List');

        $this->setPrivateProperty($list, 'id', $id);
        $this->assertEquals($id, $list->getId());
    }

    public function testTitle(): void
    {
        $list = new TaskList('Task List');
        $list->setTitle($title = 'New List');
        $this->assertEquals($title, $list->getTitle());
    }
}
