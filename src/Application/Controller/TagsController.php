<?php

declare(strict_types=1);

namespace Skeleton\Application\Controller;

use Fig\Http\Message\StatusCodeInterface as HttpCode;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Skeleton\Application\Serializer\Serializer;
use Skeleton\Domain\TagService;

class TagsController
{
    private Serializer $serializer;

    /**
     * @var TagService
     */
    private $tagService;

    public function __construct(Serializer $serializer, TagService $tagService)
    {
        $this->serializer = $serializer;
        $this->tagService = $tagService;
    }

    /**
     * @param string[] $args
     */
    public function getTagsAction(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $tags = $this->tagService->getTags();

        // Return response as JSON
        return $this->serializer->serialize($response, $tags);
    }

    /**
     * @param string[] $args
     */
    public function createTagAction(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        /** @var array $tagData */
        $tagData = $request->getParsedBody();
        $tag = $this->tagService->createTag($tagData['title']);

        // Return response as JSON with 201 Created code
        return $this->serializer->serialize($response, $tag, HttpCode::STATUS_CREATED);
    }
}
