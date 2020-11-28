<?php

declare(strict_types=1);

namespace Skeleton\App\Controller;

use Fig\Http\Message\StatusCodeInterface as HttpCode;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Skeleton\App\Serializer\Serializer;

class TagsController
{
    private Serializer $serializer;

    public function __construct(Serializer $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @param string[] $args
     */
    public function getTagsAction(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        // TODO: fetch list of available tags
        $tags = [];

        // Return response as JSON
        return $this->serializer->serialize($response, $tags);
    }

    /**
     * @param string[] $args
     */
    public function getTagAction(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        // TODO: fetch tag by ID
        $tags = [
            'id'    => $args['tag_id'],
            'title' => 'Tag ' . $args['tag_id'],
        ];

        // Return response as JSON
        return $this->serializer->serialize($response, $tags);
    }

    /**
     * @param string[] $args
     */
    public function createTagAction(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        // TODO: add new tag
        $tag = $request->getParsedBody();
        $tag = \array_merge(['id' => '1'], $tag);

        // Return response as JSON with 201 Created code
        return $this->serializer->serialize($response, $tag, HttpCode::STATUS_CREATED);
    }
}
