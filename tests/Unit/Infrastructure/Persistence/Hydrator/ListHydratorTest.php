<?php

declare(strict_types=1);

namespace Skeleton\Test\Unit\Infrastructure\Persistence\Hydrator;

use PHPUnit\Framework\TestCase;
use Skeleton\Domain\ListEnity;
use Skeleton\Infrastructure\Persistence\Hydrator\ListHydrator;
use Skeleton\Test\Unit\Traits\Visibility;

final class ListHydratorTest extends TestCase
{
    use Visibility;

    /**
     * @dataProvider hydrateProvider
     */
    public function testHydrate(array $list, ListEnity $expected): void
    {
        $hydrator = new ListHydrator();
        $this->assertEquals($expected, $hydrator->hydrate($list));
    }

    /**
     * @dataProvider toArrayProvider
     */
    public function testToArray(ListEnity $list, array $expected): void
    {
        $hydrator = new ListHydrator();
        $this->assertEquals($expected, $hydrator->toArray($list));
    }

    public function hydrateProvider(): array
    {
        $expected = new ListEnity($title = 'New List');
        $list     = [
            'id'    => null,
            'title' => $title,
        ];

        $expectedWithId = new ListEnity($title = 'List With ID');
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
        $list     = new ListEnity($title = 'New List');
        $expected = [
            'id'    => null,
            'title' => $title,
        ];

        $listWithId = new ListEnity($title = 'List With ID');
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
