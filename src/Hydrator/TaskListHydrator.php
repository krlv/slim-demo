<?php

declare(strict_types=1);

namespace Skeleton\Hydrator;

use Skeleton\Entity\TaskList;

final class TaskListHydrator extends AbstractHydrator
{
    public function hydrate(array $data): object
    {
        $list = new TaskList($data['title']);

        if (isset($data['id'])) {
            $this->setPrivateProperty($list, 'id', (int) $data['id']);
        }

        return $list;
    }

    /**
     * @param TaskList $list
     *
     * @return array
     */
    public function toArray(object $list): array
    {
        return [
            'id'    => $list->getId(),
            'title' => $list->getTitle(),
        ];
    }
}
