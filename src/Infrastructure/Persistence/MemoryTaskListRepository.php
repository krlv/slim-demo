<?php

declare(strict_types=1);

namespace Skeleton\Infrastructure\Persistence;

use Skeleton\Domain\TaskList;
use Skeleton\Domain\TaskListRepository;
use Skeleton\Infrastructure\Persistence\Hydrator\TaskListHydrator;

final class MemoryTaskListRepository implements TaskListRepository
{
    private TaskListHydrator $hydrator;

    public function __construct(TaskListHydrator $hydrator)
    {
        $this->hydrator = $hydrator;
    }

    /**
     * @return TaskList[]
     */
    public function find(): array
    {
        // TODO: Implement find() method.
        return \array_map(
            function (array $taskData) {
                return $this->hydrator->hydrate($taskData);
            },
            [
                ['id' => 1, 'title' => 'Task List 1'],
                ['id' => 2, 'title' => 'Task List 2'],
            ]
        );
    }

    public function findById(int $id): TaskList
    {
        // TODO: Implement findById() method.
        return $this->hydrator->hydrate([
            'id'    => $id,
            'title' => \sprintf('Task List %d', $id),
        ]);
    }

    public function store(TaskList $taskList): TaskList
    {
        // TODO: Implement insert/update methods.
        $taskListData = $this->hydrator->toArray($taskList);
        $taskListData['id'] = 1;
        $taskList = $this->hydrator->hydrate($taskListData);

        return $taskList;
    }
}
