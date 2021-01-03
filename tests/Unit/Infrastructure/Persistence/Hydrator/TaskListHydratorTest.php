<?php

declare(strict_types=1);

namespace Skeleton\Test\Unit\Infrastructure\Persistence\Hydrator;

use PHPUnit\Framework\TestCase;
use Skeleton\Domain\TaskList;
use Skeleton\Infrastructure\Persistence\Hydrator\TaskListHydrator;
use Skeleton\Test\Unit\Traits\Visibility;

final class TaskListHydratorTest extends TestCase
{
    use Visibility;

    /**
     * @dataProvider hydrateProvider
     */
    public function testHydrate(array $list, TaskList $expected): void
    {
        $hydrator = new TaskListHydrator();
        $this->assertEquals($expected, $hydrator->hydrate($list));
    }

    /**
     * @dataProvider toArrayProvider
     */
    public function testToArray(TaskList $list, array $expected): void
    {
        $hydrator = new TaskListHydrator();
        $this->assertEquals($expected, $hydrator->toArray($list));
    }

    public function hydrateProvider(): array
    {
        $expected = new TaskList($title = 'New List');
        $list     = [
            'id'    => null,
            'title' => $title,
        ];

        $expectedWithId = new TaskList($title = 'List With ID');
        $this->setPrivateProperty($expectedWithId, 'id', $id = 1);

        $listWithId = [
            'id'    => $id,
            'title' => $title,
        ];

        return [
            [$list, $expected],
            [$listWithId, $expectedWithId],
        ];
    }

    public function toArrayProvider(): array
    {
        $list     = new TaskList($title = 'New List');
        $expected = [
            'id'    => null,
            'title' => $title,
        ];

        $listWithId = new TaskList($title = 'List With ID');
        $this->setPrivateProperty($listWithId, 'id', $id = 1);

        $expectedWithId = [
            'id'    => $id,
            'title' => $title,
        ];

        return [
            [$list, $expected],
            [$listWithId, $expectedWithId],
        ];
    }
}
