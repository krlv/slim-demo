<?php

declare(strict_types=1);

namespace Skeleton\Infrastructure\Persistence\Hydrator;

use Skeleton\Domain\ListEnity;

final class ListHydrator extends AbstractHydrator
{
    public function hydrate(array $data): ListEnity
    {
        $reflection = new \ReflectionClass(ListEnity::class);

        /** @var ListEnity $list */
        $list = $reflection->newInstanceWithoutConstructor();

        if (isset($data['id'])) {
            $this->setPrivateProperty($list, 'id', (int) $data['id']);
        }

        if (isset($data['title'])) {
            $list->setTitle($data['title']);
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
