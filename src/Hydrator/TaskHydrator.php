<?php

declare(strict_types=1);

namespace Skeleton\Hydrator;

use Skeleton\Entity\Task;

final class TaskHydrator extends AbstractHydrator
{
    public function hydrate(array $data): object
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
     * @param Task $tag
     *
     * @return array
     */
    public function toArray(object $tag): array
    {
        $task = [
            'id'          => $tag->getId(),
            'title'       => $tag->getTitle(),
            'description' => $tag->getDescription(),
            'priority'    => $tag->getPriority(),
            'is_done'     => $tag->isDone(),
            'is_deleted'  => $tag->isDeleted(),
            'done_at'     => $tag->getDoneAt(),
            'deleted_at'  => $tag->getDeletedAt(),
        ];

        $task['done_at'] = $task['done_at']
            ? $task['done_at']->format(self::DATE_FORMAT)
            : null;

        $task['deleted_at'] = $task['deleted_at']
            ? $task['deleted_at']->format(self::DATE_FORMAT)
            : null;

        return $task;
    }
}
