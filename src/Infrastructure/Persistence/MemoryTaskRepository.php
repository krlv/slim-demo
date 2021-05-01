<?php

declare(strict_types=1);

namespace Demo\Infrastructure\Persistence;

use Demo\Domain\Task;
use Demo\Domain\TaskRepository;
use Demo\Infrastructure\Persistence\Hydrator\TaskHydrator;

final class MemoryTaskRepository implements TaskRepository
{
    private TaskHydrator $hydrator;

    public function __construct(TaskHydrator $hydrator)
    {
        $this->hydrator = $hydrator;
    }

    public function find(): array
    {
        // TODO: Implement find() method.
        return \array_map(
            function (array $taskData) {
                return $this->hydrator->hydrate($taskData);
            },
            [
                [
                    'id'          => 1,
                    'title'       => 'Task 1',
                    'description' => 'Description 1',
                    'priority'    => 1,
                    'is_done'     => false,
                    'is_deleted'  => false,
                    'done_at'     => null,
                    'deleted_at'  => null,
                ],
                [
                    'id'          => 2,
                    'title'       => 'Task 2',
                    'description' => 'Description 2',
                    'priority'    => 2,
                    'is_done'     => false,
                    'is_deleted'  => false,
                    'done_at'     => null,
                    'deleted_at'  => null,
                ],
            ]
        );
    }

    public function findById(int $id): Task
    {
        // TODO: Implement findById() method.
        return $this->hydrator->hydrate([
            'id'            => $id,
            'title'         => \sprintf('Task %d', $id),
            'description'   => \sprintf('Description %d', $id),
            'priority'      => 1,
            'is_done'       => false,
            'is_deleted'    => false,
            'done_at'       => null,
            'deleted_at'    => null,
        ]);
    }

    public function store(Task $task): Task
    {
        // TODO: Implement insert/update methods.
        $this->hydrator->assignId(1, $task);

        return $task;
    }
}
