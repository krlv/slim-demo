<?php

declare(strict_types=1);

namespace Demo\Domain;

final class ListEnity
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

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function delete(): self
    {
        // TODO: implement delete/undelete logic
        return $this;
    }
}
