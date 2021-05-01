<?php

declare(strict_types=1);

namespace Demo\Domain;

interface TagRepository
{
    /**
     * @return Tag[]
     */
    public function find(): array;

    public function store(Tag $tag): Tag;
}
