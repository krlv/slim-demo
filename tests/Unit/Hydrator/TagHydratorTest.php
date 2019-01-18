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

    /**
     * @param Tag   $tag
     * @param array $expected
     *
     * @dataProvider toArrayProvider
     */
    public function testToArray(Tag $tag, array $expected): void
    {
        $hydrator = new TagHydrator();
        $this->assertEquals($expected, $hydrator->toArray($tag));
    }

    public function hydrateProvider(): array
    {
        $expected = new Tag($title = 'New Tag');
        $tag      = [
            'id'    => null,
            'title' => $title,
        ];

        $expectedWithId = new Tag($title = 'Tag With ID');
        $this->setPrivateProperty($expectedWithId, 'id', $id = 1);

        $tagWithId = [
            'id'    => $id,
            'title' => $title,
        ];

        return [
            [$tag, $expected],
            [$tagWithId, $expectedWithId],
        ];
    }

    public function toArrayProvider(): array
    {
        $tag      = new Tag($title = 'New Tag');
        $expected = [
            'id'    => null,
            'title' => $title,
        ];

        $tagWithId = new Tag($title = 'Tag With ID');
        $this->setPrivateProperty($tagWithId, 'id', $id = 1);

        $expectedWithId = [
            'id'    => $id,
            'title' => $title,
        ];

        return [
            [$tag, $expected],
            [$tagWithId, $expectedWithId],
        ];
    }
}
