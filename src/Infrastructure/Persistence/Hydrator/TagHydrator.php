<?php

declare(strict_types=1);

namespace Demo\Infrastructure\Persistence\Hydrator;

use Demo\Domain\Tag;

final class TagHydrator extends AbstractHydrator
{
    public function hydrate(array $data): Tag
    {
        $reflection = new \ReflectionClass(Tag::class);

        /** @var Tag $tag */
        $tag = $reflection->newInstanceWithoutConstructor();

        if (isset($data['id'])) {
            $this->setPrivateProperty($tag, 'id', (int) $data['id']);
        }

        if (isset($data['title'])) {
            $this->setPrivateProperty($tag, 'title', $data['title']);
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
