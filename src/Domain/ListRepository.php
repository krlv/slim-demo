<?php

declare(strict_types=1);

namespace Demo\Domain;

interface ListRepository
{
    /**
     * @return ListEnity[]
     */
    public function find(): array;

    public function findById(int $id): ListEnity;

    public function store(ListEnity $taskList): ListEnity;
}
