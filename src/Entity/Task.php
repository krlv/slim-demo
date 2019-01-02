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
     * @var boolean
     */
    private $isDone;

    /**
     * @param string  $title
     * @param boolean $isDone
     */
    public function __construct(string $title, bool $isDone = false)
    {
        $this->title  = $title;
        $this->isDone = $isDone;
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
     * Mark the task as done
     *
     * @return $this
     */
    public function done(): self
    {
        $this->isDone = true;
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
        return $this;
    }
}
