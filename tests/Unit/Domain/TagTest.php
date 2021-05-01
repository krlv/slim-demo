<?php

declare(strict_types=1);

namespace Demo\Test\Unit\Domain;

use Demo\Domain\Tag;
use Demo\Test\Unit\Traits\Visibility;
use PHPUnit\Framework\TestCase;

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
