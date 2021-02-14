<?php

declare(strict_types=1);

namespace Skeleton\Domain;

final class TaskListService
{
    private TaskListRepository $repository;

    public function __construct(TaskListRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return TaskList[]
     */
    public function getLists(): array
    {
        return $this->repository->find();
    }

    public function getListById(int $id): TaskList
    {
        return $this->repository->findById($id);
    }

    public function createList(array $data): TaskList
    {
        $task = new TaskList($data['title']);

        return $this->repository->store($task);
    }

    public function updateList(int $id, array $data): TaskList
    {
        $list = $this->repository->findById($id);
        $list->setTitle($data['title']);
        $list = $this->repository->store($list);

        return $list;
    }

    public function deleteList(int $id): void
    {
        $list = $this->repository->findById($id);
        $list->delete();
        $this->repository->store($list);
    }
}
