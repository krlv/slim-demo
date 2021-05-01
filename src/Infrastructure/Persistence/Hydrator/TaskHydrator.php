<?php

declare(strict_types=1);

namespace Demo\Infrastructure\Persistence\Hydrator;

use Demo\Domain\Task;

final class TaskHydrator extends AbstractHydrator
{
    public function hydrate(array $data): Task
    {
        $reflection = new \ReflectionClass(Task::class);

        /** @var Task $task */
        $task = $reflection->newInstanceWithoutConstructor();

        if (isset($data['id'])) {
            $this->setPrivateProperty($task, 'id', (int) $data['id']);
        }

        if (isset($data['title'])) {
            $task->setTitle($data['title']);
        }

        if (isset($data['description'])) {
            $task->setDescription($data['description']);
        }

        if (isset($data['priority'])) {
            $task->setPriority($data['priority']);
        }

        if (isset($data['is_done'])) {
            $this->setPrivateProperty($task, 'isDone', (bool) $data['is_done']);
        }

        if (isset($data['is_deleted'])) {
            $this->setPrivateProperty($task, 'isDeleted', (bool) $data['is_deleted']);
        }

        $doneAt = isset($data['done_at']) ? new \DateTimeImmutable($data['done_at']) : null;
        $this->setPrivateProperty($task, 'doneAt', $doneAt);

        $deletedAt = isset($data['deleted_at']) ? new \DateTimeImmutable($data['deleted_at']) : null;
        $this->setPrivateProperty($task, 'deletedAt', $deletedAt);

        return $task;
    }

    /**
     * @param Task $task
     */
    public function toArray(object $task): array
    {
        $data = [
            'id'          => $task->getId(),
            'title'       => $task->getTitle(),
            'description' => $task->getDescription(),
            'priority'    => $task->getPriority(),
            'is_done'     => $task->isDone(),
            'is_deleted'  => $task->isDeleted(),
            'done_at'     => $task->getDoneAt(),
            'deleted_at'  => $task->getDeletedAt(),
        ];

        $data['done_at'] = $data['done_at']
            ? $data['done_at']->format(self::DATE_FORMAT)
            : null;

        $data['deleted_at'] = $data['deleted_at']
            ? $data['deleted_at']->format(self::DATE_FORMAT)
            : null;

        return $data;
    }

    /**
     * @param Task $task
     */
    public function assignId(int $id, object $task): void
    {
        $this->setPrivateProperty($task, 'id', $id);
    }
}
