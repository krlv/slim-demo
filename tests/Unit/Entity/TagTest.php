<?php

declare(strict_types=1);

namespace Skeleton\Test\Unit\Entity;

use PHPUnit\Framework\TestCase;
use Skeleton\Entity\Tag;
use Skeleton\Test\Unit\Traits\Visibility;

class TagTest extends TestCase
{
    use Visibility;

    public function testConstructor(): void
    {
        $tag = new Tag($title = 'Tag');
        $this->assertSame($title, $tag->getTitle());
    }

    public function testGetId(): void
    {
        $id  = 1;
        $tag = new Tag('Tag');

        $this->setPrivateProperty($tag, 'id', $id);
        $this->assertEquals($id, $tag->getId());
    }
}
