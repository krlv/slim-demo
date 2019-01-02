<?php
namespace Skeleton\Test\Unit\Entity;

use PHPUnit\Framework\TestCase;
use Skeleton\Entity\Task;
use Skeleton\Test\Unit\Traits\VisibilityTrait;

class TaskTest extends TestCase
{
    use VisibilityTrait;

    public function testConstructor()
    {
        $task = new Task($title = 'Task');
        $this->assertSame($title, $task->getTitle());
    }

    public function testGetId()
    {
        $id  = 1;
        $task = new Task('Task');

        $this->setPrivateProperty($task, 'id', $id);
        $this->assertEquals($id, $task->getId());
    }

    public function testDone()
    {
        $task = (new Task('Task'))->done();
        $this->assertTrue($this->getPrivateProperty($task, 'isDone'));
    }

    public function testUndone()
    {
        $task = (new Task('Task'))->undone();
        $this->assertFalse($this->getPrivateProperty($task, 'isDone'));
    }
}
