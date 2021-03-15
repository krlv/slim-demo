<?php

declare(strict_types=1);

namespace Skeleton\Application\Controller;

use Fig\Http\Message\StatusCodeInterface as HttpCode;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Skeleton\Application\Serializer\Serializer;
use Skeleton\Domain\TagService;
use Valitron\Validator;

class TagsController
{
    private Validator $validator;
    private Serializer $serializer;
    private TagService $tagService;

    public function __construct(Validator $validator, Serializer $serializer, TagService $tagService)
    {
        $this->validator = $validator;
        $this->validator->rule('required', 'title');

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
        $data = $request->getParsedBody();

        $v = $this->validator->withData($data);
        if (!$v->validate()) {
            return $this->serializer->serialize($response, ['errors' => $v->errors()], HttpCode::STATUS_BAD_REQUEST);
        }

        $tag = $this->tagService->createTag($data['title']);

        // Return response as JSON with 201 Created code
        return $this->serializer->serialize($response, $tag, HttpCode::STATUS_CREATED);
    }
}
