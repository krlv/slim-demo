<?php

declare(strict_types=1);

namespace Skeleton\Domain;

final class Tag
{
    private ?int $id;
    private string $title;

    public function __construct(string $title)
    {
        $this->title = $title;
    }

    public function getId(): ?int
    {
        return $this->id ?? null;
    }

    public function getTitle(): string
    {
        return $this->title;
    }
}
