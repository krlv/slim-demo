<?php

declare(strict_types=1);

namespace Skeleton\Entity;

final class TaskList
{
    /**
     * @var int|null
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    public function __construct(string $title)
    {
        $this->title = $title;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return $this
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }
}
