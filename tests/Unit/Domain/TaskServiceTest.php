<?php

declare(strict_types=1);

namespace Skeleton\Test\Unit\Domain;

use PHPUnit\Framework\TestCase;
use Skeleton\Domain\Task;
use Skeleton\Domain\TaskRepository;
use Skeleton\Domain\TaskService;

final class TaskServiceTest extends TestCase
{
    public function testGetTasks(): void
    {
        $tasks = [
            new Task('Task 1', 'Description 1'),
            new Task('Task 2', 'Description 2'),
        ];

        // Repository mock
        $repository = $this
            ->getMockBuilder(TaskRepository::class)
            ->onlyMethods(['find'])
            ->getMockForAbstractClass()
        ;

        $repository
            ->expects($this->once())
            ->method('find')
            ->willReturn($tasks)
        ;

        $service = new TaskService($repository);
        $this->assertSame($tasks, $service->getTasks());
    }

    public function testGetTaskById(): void
    {
        $task = new Task('New Task', 'New Description');

        // Repository mock
        $repository = $this
            ->getMockBuilder(TaskRepository::class)
            ->onlyMethods(['findById'])
            ->getMockForAbstractClass()
        ;

        $repository
            ->expects($this->once())
            ->method('findById')
            ->with($this->equalTo($id = 1))
            ->willReturn($task)
        ;

        $service = new TaskService($repository);
        $this->assertSame($task, $service->getTaskById($id));
    }

    public function testCreateTask(): void
    {
        $data = [
            'title'       => 'New Task',
            'description' => 'New Description',
        ];

        $task = new Task('New Task', 'New Description');

        // Repository mock
        $repository = $this
            ->getMockBuilder(TaskRepository::class)
            ->onlyMethods(['store'])
            ->getMockForAbstractClass()
        ;

        $repository
            ->expects($this->once())
            ->method('store')
            ->with($this->equalTo($task))
            ->willReturn($task)
        ;

        $service = new TaskService($repository);
        $this->assertSame($task, $service->createTask($data));
    }

    public function testUpdateTask(): void
    {
        $data = [
            'title'       => 'New Task',
            'description' => 'New Description',
        ];

        $task = new Task('Old Task', 'Old Description');

        // Repository mock
        $repository = $this
            ->getMockBuilder(TaskRepository::class)
            ->onlyMethods(['findById', 'store'])
            ->getMockForAbstractClass()
        ;

        $repository
            ->expects($this->once())
            ->method('findById')
            ->with($this->equalTo($id = 1))
            ->willReturn($task)
        ;

        $task->setTitle('New Task');
        $task->setDescription('New Description');

        $repository
            ->expects($this->once())
            ->method('store')
            ->with($this->equalTo($task))
            ->willReturn($task)
        ;

        $service = new TaskService($repository);
        $this->assertSame($task, $service->updateTask($id, $data));
    }

    public function testDeleteTask(): void
    {
        $task = new Task('New Task', 'New Description');

        // Repository mock
        $repository = $this
            ->getMockBuilder(TaskRepository::class)
            ->onlyMethods(['findById', 'store'])
            ->getMockForAbstractClass()
        ;

        $repository
            ->expects($this->once())
            ->method('findById')
            ->with($this->equalTo($id = 1))
            ->willReturn($task)
        ;

        $task->delete();

        $repository
            ->expects($this->once())
            ->method('store')
            ->with($this->equalTo($task))
            ->willReturn($task)
        ;

        $service = new TaskService($repository);
        $service->deleteTask($id);
    }
}
