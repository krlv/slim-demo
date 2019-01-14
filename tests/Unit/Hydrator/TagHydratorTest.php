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

    public function testHydrate(): void
    {
        $tag = [
            'title' => 'New Tag',
        ];

        $expected = new Tag('New Tag');
        $hydrator = new TagHydrator();
        $actual   = $hydrator->hydrate($tag);

        $this->assertEquals($expected, $actual);
    }

    public function testHydrateWithId(): void
    {
        $tag = [
            'id'    => 1,
            'title' => 'New Tag',
        ];

        $expected = new Tag('New Tag');
        $this->setPrivateProperty($expected, 'id', 1);

        $hydrator = new TagHydrator();
        $actual   = $hydrator->hydrate($tag);

        $this->assertEquals($expected, $actual);
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
}
