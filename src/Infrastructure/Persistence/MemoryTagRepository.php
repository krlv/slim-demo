<?php

declare(strict_types=1);

namespace Demo\Infrastructure\Persistence;

use Demo\Domain\Tag;
use Demo\Domain\TagRepository;
use Demo\Infrastructure\Persistence\Hydrator\TagHydrator;

final class MemoryTagRepository implements TagRepository
{
    private TagHydrator $hydrator;

    public function __construct(TagHydrator $hydrator)
    {
        $this->hydrator = $hydrator;
    }

    public function find(): array
    {
        return \array_map(
            function (array $tagData) {
                return $this->hydrator->hydrate($tagData);
            },
            [
                ['id' => 1, 'title' => 'Tag 1'],
                ['id' => 2, 'title' => 'Tag 2'],
                ['id' => 3, 'title' => 'Tag 3'],
            ]
        );
    }

    public function store(Tag $tag): Tag
    {
        $this->hydrator->assignId(1, $tag);

        return $tag;
    }
}
