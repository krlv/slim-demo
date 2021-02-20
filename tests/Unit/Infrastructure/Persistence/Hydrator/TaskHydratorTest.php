<?php

declare(strict_types=1);

namespace Skeleton\Test\Unit\Infrastructure\Persistence\Hydrator;

use PHPUnit\Framework\TestCase;
use Skeleton\Domain\Task;
use Skeleton\Infrastructure\Persistence\Hydrator\TaskHydrator;
use Skeleton\Test\Unit\Traits\Visibility;

final class TaskHydratorTest extends TestCase
{
    use Visibility;

    /**
     * @dataProvider hydrateProvider
     */
    public function testHydrate(array $task, Task $expected): void
    {
        $hydrator = new TaskHydrator();
        $this->assertEquals($expected, $hydrator->hydrate($task));
    }

    /**
     * @dataProvider toArrayProvider
     */
    public function testToArray(Task $task, array $expected): void
    {
        $hydrator = new TaskHydrator();
        $this->assertEquals($expected, $hydrator->toArray($task));
    }

    public function hydrateProvider(): array
    {
        $task = [
            'id'          => $id        = 1,
            'title'       => $title     = 'New Task',
            'description' => $desc      = 'New Desc',
            'priority'    => $priority  = 1,
            'is_done'     => $isDone    = 1,
            'is_deleted'  => $isDeleted = 1,
            'done_at'     => $doneAt    = '2019-01-01 00:00:01',
            'deleted_at'  => $deletedAt = '2019-01-10 00:00:01',
        ];

        $expected = new Task(
            $title,
            $desc,
            $priority,
            (bool) $isDone,
            (bool) $isDeleted,
            new \DateTimeImmutable($doneAt),
            new \DateTimeImmutable($deletedAt),
        );
        $this->setPrivateProperty($expected, 'id', $id);

        return [
            [$task, $expected],
        ];
    }

    public function toArrayProvider(): array
    {
        $taskDefaults     = new Task('New Task');
        $expectedDefaults = [
            'id'          => null,
            'title'       => 'New Task',
            'description' => '',
            'priority'    => 0,
            'is_done'     => false,
            'is_deleted'  => false,
            'done_at'     => null,
            'deleted_at'  => null,
        ];

        $task = new Task(
            $title     = 'New Task',
            $desc      = 'New Desc',
            $priority  = 1,
            $isDone    = true,
            $isDeleted = false,
            new \DateTimeImmutable($doneAt = '2019-01-01 00:00:01'),
            $deletedAt = null,
        );
        $this->setPrivateProperty($task, 'id', $id = 1);

        $expected = [
            'id'          => $id,
            'title'       => $title,
            'description' => $desc,
            'priority'    => $priority,
            'is_done'     => $isDone,
            'is_deleted'  => $isDeleted,
            'done_at'     => $doneAt,
            'deleted_at'  => $deletedAt,
        ];

        return [
            [$taskDefaults, $expectedDefaults],
            [$task, $expected],
        ];
    }
}
