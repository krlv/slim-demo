<?php

declare(strict_types=1);

namespace Demo\Domain;

final class TaskService
{
    private TaskRepository $repository;

    public function __construct(TaskRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return Task[]
     */
    public function getTasks(): array
    {
        return $this->repository->find();
    }

    public function getTaskById(int $id): Task
    {
        return $this->repository->findById($id);
    }

    public function createTask(array $data): Task
    {
        $task = new Task($data['title'], $data['description']);

        return $this->repository->store($task);
    }

    public function updateTask(int $id, array $data): Task
    {
        $task = $this->repository->findById($id);
        $task->setTitle($data['title']);
        $task->setDescription($data['description']);
        $task = $this->repository->store($task);

        return $task;
    }

    public function deleteTask(int $id): void
    {
        $task = $this->repository->findById($id);
        $task->delete();
        $task = $this->repository->store($task);
    }
}
