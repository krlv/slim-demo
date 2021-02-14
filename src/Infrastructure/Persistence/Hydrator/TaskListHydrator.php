<?php

declare(strict_types=1);

namespace Skeleton\Infrastructure\Persistence\Hydrator;

use Skeleton\Domain\TaskList;

final class TaskListHydrator extends AbstractHydrator
{
    public function hydrate(array $data): TaskList
    {
        $list = new TaskList($data['title']);

        if (isset($data['id'])) {
            $this->setPrivateProperty($list, 'id', (int) $data['id']);
        }

        return $list;
    }

    /**
     * @param TaskList $list
     */
    public function toArray(object $list): array
    {
        return [
            'id'    => $list->getId(),
            'title' => $list->getTitle(),
        ];
    }
}
