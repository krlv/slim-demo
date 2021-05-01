<?php

declare(strict_types=1);

namespace Demo\Domain;

interface TaskRepository
{
    /**
     * @return Task[]
     */
    public function find(): array;

    public function findById(int $id): Task;

    public function store(Task $task): Task;
}
