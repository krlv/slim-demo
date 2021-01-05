<?php

declare(strict_types=1);

namespace Skeleton\Infrastructure\Persistence;

use Skeleton\Domain\Tag;
use Skeleton\Domain\TagRepository;
use Skeleton\Infrastructure\Persistence\Hydrator\TagHydrator;

final class MemoryTagRepository implements TagRepository
{
    /**
     * @var TagHydrator
     */
    private $hydrator;

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
        $tagData = $this->hydrator->toArray($tag);
        $tagData['id'] = 1;

        /** @var Tag $tag */
        $tag = $this->hydrator->hydrate($tagData);

        return $tag;
    }
}
