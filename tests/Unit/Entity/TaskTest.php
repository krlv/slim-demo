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
        $task = new Task(
            $title       = 'Task',
            $description = 'Task Description',
            $priority    = 1,
            $isDone      = true,
            $isDeleted   = true,
            $doneAt      = new \DateTimeImmutable('+1 day'),
            $deletedAt   = new \DateTimeImmutable('+2 day'),
        );

        $this->assertSame($title, $task->getTitle());
        $this->assertSame($description, $task->getDescription());
        $this->assertSame($priority, $task->getPriority());
        $this->assertSame($isDone, $task->isDone());
        $this->assertSame($isDeleted, $task->isDeleted());
        $this->assertSame($doneAt, $task->getDoneAt());
        $this->assertSame($deletedAt, $task->getDeletedAt());
    }

    public function testGetId()
    {
        $id  = 1;
        $task = new Task('Task');

        $this->setPrivateProperty($task, 'id', $id);
        $this->assertEquals($id, $task->getId());
    }

    public function testTitle()
    {
        $task = new Task('Task');
        $task->setTitle($title = 'New Task');
        $this->assertEquals($title, $task->getTitle());
    }

    public function testDescription()
    {
        $task = new Task('Task');
        $task->setDescription($description = 'Description');
        $this->assertEquals($description, $task->getDescription());
    }

    public function testPriority()
    {
        $task = new Task('Task');
        $task->setPriority($priority = 10);
        $this->assertEquals($priority, $task->getPriority());
    }

    public function testDone()
    {
        $task = (new Task('Task'))->done();
        $this->assertTrue($task->isDone());
        $this->assertInstanceOf(\DateTimeImmutable::class, $task->getDoneAt());
    }

    public function testUndone()
    {
        $task = (new Task('Task'))->undone();
        $this->assertFalse($task->isDone());
        $this->assertNull($task->getDoneAt());
    }

    public function testDelete()
    {
        $task = (new Task('Task'))->delete();
        $this->assertTrue($task->isDeleted());
        $this->assertInstanceOf(\DateTimeImmutable::class, $task->getDeletedAt());
    }

    public function testRestore()
    {
        $task = (new Task('Task'))->restore();
        $this->assertFalse($task->isDeleted());
        $this->assertNull($task->getDeletedAt());
    }
}
