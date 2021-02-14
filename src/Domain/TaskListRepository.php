<?php

declare(strict_types=1);

namespace Skeleton\Domain;

interface TaskListRepository
{
    /**
     * @return TaskList[]
     */
    public function find(): array;

    public function findById(int $id): TaskList;

    public function store(TaskList $taskList): TaskList;
}
