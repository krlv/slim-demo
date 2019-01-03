<?php
namespace Skeleton\Test\Unit\Entity;

use PHPUnit\Framework\TestCase;
use Skeleton\Entity\TaskList;
use Skeleton\Test\Unit\Traits\VisibilityTrait;

class TaskListTest extends TestCase
{
    use VisibilityTrait;

    public function testConstructor()
    {
        $list = new TaskList($title = 'Task List');
        $this->assertSame($title, $list->getTitle());
    }

    public function testGetId()
    {
        $id  = 1;
        $list = new TaskList('Task List');

        $this->setPrivateProperty($list, 'id', $id);
        $this->assertEquals($id, $list->getId());
    }
}
