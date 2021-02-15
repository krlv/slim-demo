<?php

declare(strict_types=1);

namespace Skeleton\Domain;

interface TagRepository
{
    /**
     * @return Tag[]
     */
    public function find(): array;

    public function store(Tag $tag): Tag;
}
