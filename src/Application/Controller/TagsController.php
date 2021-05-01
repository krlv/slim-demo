<?php

declare(strict_types=1);

namespace Demo\Application\Controller;

use Demo\Application\Serializer\Serializer;
use Demo\Domain\TagService;
use Fig\Http\Message\StatusCodeInterface as HttpCode;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class TagsController
{
    private Serializer $serializer;
    private TagService $tagService;

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
        $tagData = $request->getParsedBody();
        $tag = $this->tagService->createTag($tagData['title']);

        // Return response as JSON with 201 Created code
        return $this->serializer->serialize($response, $tag, HttpCode::STATUS_CREATED);
    }
}
