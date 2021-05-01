<?php

declare(strict_types=1);

namespace Demo\Domain;

final class ListService
{
    private ListRepository $repository;

    public function __construct(ListRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return ListEnity[]
     */
    public function getLists(): array
    {
        return $this->repository->find();
    }

    public function getListById(int $id): ListEnity
    {
        return $this->repository->findById($id);
    }

    public function createList(array $data): ListEnity
    {
        $task = new ListEnity($data['title']);

        return $this->repository->store($task);
    }

    public function updateList(int $id, array $data): ListEnity
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
