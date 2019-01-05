<?php
namespace Skeleton\Entity;

final class Task
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $description;

    /**
     * @var int
     */
    private $priority;

    /**
     * @var boolean
     */
    private $isDone;

    /**
     * @var boolean
     */
    private $isDeleted;

    /**
     * @var ?\DateTimeImmutable
     */
    private $doneAt;

    /**
     * @var ?\DateTimeImmutable
     */
    private $deletedAt;

    /**
     * @param string                  $title
     * @param string                  $description
     * @param int                     $priority
     * @param bool                    $isDone
     * @param bool                    $isDeleted
     * @param \DateTimeImmutable|null $doneAt
     * @param \DateTimeImmutable|null $deletedAt
     */
    public function __construct(
        string $title,
        string $description = '',
        int $priority = 0,
        bool $isDone = false,
        bool $isDeleted = false,
        \DateTimeImmutable $doneAt = null,
        \DateTimeImmutable $deletedAt = null
    ) {
        $this->title       = $title;
        $this->description = $description;
        $this->priority    = $priority;
        $this->isDone      = $isDone;
        $this->isDeleted   = $isDeleted;
        $this->doneAt      = $doneAt;
        $this->deletedAt   = $deletedAt;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return $this
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return $this
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return int
     */
    public function getPriority(): int
    {
        return $this->priority;
    }

    /**
     * @param int $priority
     * @return $this
     */
    public function setPriority(int $priority): self
    {
        $this->priority = $priority;
        return $this;
    }

    /**
     * @return bool
     */
    public function isDone(): bool
    {
        return $this->isDone;
    }

    /**
     * @return bool
     */
    public function isDeleted(): bool
    {
        return $this->isDeleted;
    }

    /**
     * @return \DateTimeImmutable|null
     */
    public function getDoneAt(): ?\DateTimeImmutable
    {
        return $this->doneAt;
    }

    /**
     * @return \DateTimeImmutable|null
     */
    public function getDeletedAt(): ?\DateTimeImmutable
    {
        return $this->deletedAt;
    }

    /**
     * Mark the task as done
     *
     * @return $this
     */
    public function done(): self
    {
        $this->isDone = true;
        $this->doneAt = new \DateTimeImmutable;
        return $this;
    }

    /**
     * Mark the task as undone
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
     * Mark the task as deleted (hide the task)
     *
     * @return $this
     */
    public function delete(): self
    {
        $this->isDeleted = true;
        $this->deletedAt = new \DateTimeImmutable;
        return $this;
    }

    /**
     * Mark the task as un-deleted (undo the task deletion)
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
