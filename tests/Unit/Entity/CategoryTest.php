<?php
namespace Skeleton\Test\Unit\Entity;

use PHPUnit\Framework\TestCase;
use Skeleton\Entity\Category;
use Skeleton\Test\Unit\Traits\VisibilityTrait;

class CategoryTest extends TestCase
{
    use VisibilityTrait;

    public function testConstructor()
    {
        $category = new Category($title = 'Category');
        $this->assertSame($title, $category->getTitle());
    }

    public function testGetId()
    {
        $id  = 1;
        $category = new Category('Category');

        $this->setPrivateProperty($category, 'id', $id);
        $this->assertEquals($id, $category->getId());
    }
}
