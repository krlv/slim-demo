<?php

declare(strict_types=1);

namespace Skeleton\Infrastructure\Persistence\Hydrator;

use Skeleton\Domain\Task;

final class TaskHydrator extends AbstractHydrator
{
    public function hydrate(array $data): Task
    {
        $task = new Task($data['title']);

        if (isset($data['id'])) {
            $this->setPrivateProperty($task, 'id', (int) $data['id']);
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

        if (isset($data['done_at'])) {
            $this->setPrivateProperty($task, 'doneAt', new \DateTimeImmutable($data['done_at']));
        }

        if (isset($data['deleted_at'])) {
            $this->setPrivateProperty($task, 'deletedAt', new \DateTimeImmutable($data['deleted_at']));
        }

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
