<?php

declare(strict_types=1);

namespace Skeleton\Infrastructure\Persistence\Hydrator;

use Skeleton\Domain\Tag;

final class TagHydrator extends AbstractHydrator
{
    public function hydrate(array $data): object
    {
        $tag = new Tag($data['title']);

        if (isset($data['id'])) {
            $this->setPrivateProperty($tag, 'id', (int) $data['id']);
        }

        return $tag;
    }

    /**
     * @param Tag $tag
     */
    public function toArray(object $tag): array
    {
        return [
            'id'    => $tag->getId(),
            'title' => $tag->getTitle(),
        ];
    }
}
