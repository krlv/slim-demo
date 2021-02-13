<?php

declare(strict_types=1);

namespace Skeleton\Infrastructure\Persistence;

use Skeleton\Domain\Task;
use Skeleton\Domain\TaskRepository;
use Skeleton\Infrastructure\Persistence\Hydrator\TaskHydrator;

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
                ['id' => 1, 'title' => 'Task 1', 'description' => 'Description 1'],
                ['id' => 2, 'title' => 'Task 2', 'description' => 'Description 2'],
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
        ]);
    }

    public function store(Task $task): Task
    {
        // TODO: Implement insert/update methods.
        $taskData = $this->hydrator->toArray($task);
        $taskData['id'] = 1;
        $task = $this->hydrator->hydrate($taskData);

        return $task;
    }
}
