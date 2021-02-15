<?php

declare(strict_types=1);

namespace Skeleton\Test\Unit\Domain;

use PHPUnit\Framework\TestCase;
use Skeleton\Domain\Tag;
use Skeleton\Domain\TagRepository;
use Skeleton\Domain\TagService;

class TagServiceTest extends TestCase
{
    public function testGetTags(): void
    {
        $tags = [
            new Tag('Tag 1'),
            new Tag('Tag 2'),
            new Tag('Tag 3'),
        ];

        // Repository mock
        $repository = $this
            ->getMockBuilder(TagRepository::class)
            ->onlyMethods(['find'])
            ->getMockForAbstractClass()
        ;

        $repository
            ->expects($this->once())
            ->method('find')
            ->willReturn($tags)
        ;

        $service = new TagService($repository);
        $this->assertSame($tags, $service->getTags());
    }

    public function testCreateTag(): void
    {
        $tag = new Tag('New Tag');

        // Repository mock
        $repository = $this
            ->getMockBuilder(TagRepository::class)
            ->onlyMethods(['store'])
            ->getMockForAbstractClass()
        ;

        $repository
            ->expects($this->once())
            ->method('store')
            ->with($this->equalTo($tag))
            ->willReturn($tag)
        ;

        $service = new TagService($repository);
        $this->assertSame($tag, $service->createTag('New Tag'));
    }
}
