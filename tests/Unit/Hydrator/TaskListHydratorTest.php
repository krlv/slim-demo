<?php

declare(strict_types=1);

namespace Skeleton\Test\Unit\Hydrator;

use PHPUnit\Framework\TestCase;
use Skeleton\Entity\TaskList;
use Skeleton\Hydrator\TaskListHydrator;
use Skeleton\Test\Unit\Traits\VisibilityTrait;

final class TaskListHydratorTest extends TestCase
{
    use VisibilityTrait;

    public function testHydrate(): void
    {
        $list = [
            'title' => 'New List',
        ];

        $expected = new TaskList('New List');
        $hydrator = new TaskListHydrator();
        $actual   = $hydrator->hydrate($list);

        $this->assertEquals($expected, $actual);
    }

    public function testHydrateWithId(): void
    {
        $list = [
            'id'    => 1,
            'title' => 'New List',
        ];

        $expected = new TaskList('New List');
        $this->setPrivateProperty($expected, 'id', 1);

        $hydrator = new TaskListHydrator();
        $actual   = $hydrator->hydrate($list);

        $this->assertEquals($expected, $actual);
    }

    public function testToArray(): void
    {
        $expected = [
            'id'    => 1,
            'title' => 'New List',
        ];

        $list = new TaskList('New List');
        $this->setPrivateProperty($list, 'id', 1);

        $hydrator = new TaskListHydrator();
        $actual   = $hydrator->toArray($list);

        $this->assertEquals($expected, $actual);
    }
}
