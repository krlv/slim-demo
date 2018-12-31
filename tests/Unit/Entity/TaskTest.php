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
        $category = new Task('Category');

        $this->setPrivateProperty($category, 'id', $id);
        $this->assertEquals($id, $category->getId());
    }
}
