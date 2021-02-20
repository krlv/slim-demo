<?php

declare(strict_types=1);

namespace Skeleton\Infrastructure\Persistence\Hydrator;

use Skeleton\Domain\Tag;

final class TagHydrator extends AbstractHydrator
{
    public function hydrate(array $data): Tag
    {
        $tag = new Tag($data['title']);

        if (isset($data['id'])) {
            $this->setPrivateProperty($tag, 'id', (int) $data['id']);
        }

        return $tag;
    }

    /**
     * @param Tag $task
     */
    public function toArray(object $task): array
    {
        return [
            'id'    => $task->getId(),
            'title' => $task->getTitle(),
        ];
    }

    /**
     * @param Tag $tag
     */
    public function assignId(int $id, object $tag): void
    {
        $this->setPrivateProperty($tag, 'id', $id);
    }
}
