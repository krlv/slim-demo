<?php

declare(strict_types=1);

namespace Skeleton\Test\Unit\Hydrator;

use PHPUnit\Framework\TestCase;
use Skeleton\Entity\Tag;
use Skeleton\Hydrator\TagHydrator;
use Skeleton\Test\Unit\Traits\VisibilityTrait;

final class TagHydratorTest extends TestCase
{
    use VisibilityTrait;

    /**
     * @param array $tag
     * @param Tag   $expected
     *
     * @dataProvider hydrateProvider
     */
    public function testHydrate(array $tag, Tag $expected): void
    {
        $hydrator = new TagHydrator();
        $this->assertEquals($expected, $hydrator->hydrate($tag));
    }

    public function testToArray(): void
    {
        $expected = [
            'id'    => 1,
            'title' => 'New Tag',
        ];

        $tag = new Tag('New Tag');
        $this->setPrivateProperty($tag, 'id', 1);

        $hydrator = new TagHydrator();
        $actual   = $hydrator->toArray($tag);

        $this->assertEquals($expected, $actual);
    }

    public function hydrateProvider(): array
    {
        $expected = new Tag('New Tag');
        $tag      = [
            'id'    => null,
            'title' => 'New Tag',
        ];

        $expectedWithId = new Tag('Tag With ID');
        $this->setPrivateProperty($expectedWithId, 'id', $id = 1);

        $tagWithId = [
            'id'    => $id,
            'title' => 'Tag With ID',
        ];

        return [
            [$tag, $expected],
            [$tagWithId, $expectedWithId],
        ];
    }
}
