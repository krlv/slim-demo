<?php

declare(strict_types=1);

namespace Skeleton\Infrastructure\Persistence\Hydrator;

use Skeleton\Domain\ListEnity;

final class ListHydrator extends AbstractHydrator
{
    public function hydrate(array $data): ListEnity
    {
        $list = new ListEnity($data['title']);

        if (isset($data['id'])) {
            $this->setPrivateProperty($list, 'id', (int) $data['id']);
        }

        return $list;
    }

    /**
     * @param ListEnity $list
     */
    public function toArray(object $list): array
    {
        return [
            'id'    => $list->getId(),
            'title' => $list->getTitle(),
        ];
    }

    /**
     * @param ListEnity $list
     */
    public function assignId(int $id, object $list): void
    {
        $this->setPrivateProperty($list, 'id', $id);
    }
}
