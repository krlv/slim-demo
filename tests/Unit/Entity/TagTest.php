<?php
namespace Skeleton\Test\Unit\Entity;

use PHPUnit\Framework\TestCase;
use Skeleton\Entity\Tag;
use Skeleton\Test\Unit\Traits\VisibilityTrait;

class TagTest extends TestCase
{
    use VisibilityTrait;

    public function testConstructor()
    {
        $tag = new Tag($title = 'Tag');
        $this->assertSame($title, $tag->getTitle());
    }

    public function testGetId()
    {
        $id  = 1;
        $tag = new Tag('Tag');

        $this->setPrivateProperty($tag, 'id', $id);
        $this->assertEquals($id, $tag->getId());
    }
}
