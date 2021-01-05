<?php

declare(strict_types=1);

namespace Skeleton\Domain;

final class TagService
{
    /**
     * @var TagRepository
     */
    private $repository;

    public function __construct(TagRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getTags(): array
    {
        return $this->repository->find();
    }

    public function createTag(string $title): Tag
    {
        $tag = new Tag($title);
        $tag = $this->repository->store($tag);

        return $tag;
    }
}
