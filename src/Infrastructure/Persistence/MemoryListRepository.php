<?php

declare(strict_types=1);

namespace Demo\Infrastructure\Persistence;

use Demo\Domain\ListEnity;
use Demo\Domain\ListRepository;
use Demo\Infrastructure\Persistence\Hydrator\ListHydrator;

final class MemoryListRepository implements ListRepository
{
    private ListHydrator $hydrator;

    public function __construct(ListHydrator $hydrator)
    {
        $this->hydrator = $hydrator;
    }

    /**
     * @return ListEnity[]
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

    public function findById(int $id): ListEnity
    {
        // TODO: Implement findById() method.
        return $this->hydrator->hydrate([
            'id'    => $id,
            'title' => \sprintf('Task List %d', $id),
        ]);
    }

    public function store(ListEnity $taskList): ListEnity
    {
        // TODO: Implement insert/update methods.
        $this->hydrator->assignId(1, $taskList);

        return $taskList;
    }
}
