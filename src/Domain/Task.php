<?php

declare(strict_types=1);

namespace Skeleton\Domain;

final class Task
{
    private ?int $id;
    private string $title;
    private string $description;
    private int $priority;
    private bool $isDone;
    private bool $isDeleted;
    private ?\DateTimeImmutable $doneAt;
    private ?\DateTimeImmutable $deletedAt;

    public function __construct(
        string $title,
        string $description = '',
        int $priority = 0,
        bool $isDone = false,
        bool $isDeleted = false,
        ?\DateTimeImmutable $doneAt = null,
        ?\DateTimeImmutable $deletedAt = null
    ) {
        $this->title       = $title;
        $this->description = $description;
        $this->priority    = $priority;
        $this->isDone      = $isDone;
        $this->isDeleted   = $isDeleted;
        $this->doneAt      = $doneAt;
        $this->deletedAt   = $deletedAt;
    }

    public function getId(): ?int
    {
        return $this->id ?? null;
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

    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return $this
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPriority(): int
    {
        return $this->priority;
    }

    /**
     * @return $this
     */
    public function setPriority(int $priority): self
    {
        $this->priority = $priority;

        return $this;
    }

    public function isDone(): bool
    {
        return $this->isDone;
    }

    public function isDeleted(): bool
    {
        return $this->isDeleted;
    }

    public function getDoneAt(): ?\DateTimeImmutable
    {
        return $this->doneAt;
    }

    public function getDeletedAt(): ?\DateTimeImmutable
    {
        return $this->deletedAt;
    }

    /**
     * Mark the task as done.
     *
     * @return $this
     */
    public function done(): self
    {
        $this->isDone = true;
        $this->doneAt = new \DateTimeImmutable();

        return $this;
    }

    /**
     * Mark the task as undone.
     *
     * @return $this
     */
    public function undone(): self
    {
        $this->isDone = false;
        $this->doneAt = null;

        return $this;
    }

    /**
     * Mark the task as deleted (hide the task).
     *
     * @return $this
     */
    public function delete(): self
    {
        $this->isDeleted = true;
        $this->deletedAt = new \DateTimeImmutable();

        return $this;
    }

    /**
     * Mark the task as un-deleted (undo the task deletion).
     *
     * @return $this
     */
    public function restore(): self
    {
        $this->isDeleted = false;
        $this->deletedAt = null;

        return $this;
    }
}
