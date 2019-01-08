<?php

declare(strict_types=1);

namespace Skeleton\App\Controller;

use Skeleton\App\Serializer\Serializer;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\StatusCode;

class TagsController
{
    /**
     * @var Serializer
     */
    private $serializer;

    public function __construct(Serializer $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @param Request  $request
     * @param Response $response
     * @param string[] $args
     *
     * @return Response
     */
    public function getTagsAction(Request $request, Response $response, array $args): Response
    {
        // TODO: fetch list of available tags
        $tags = [];

        // Return response as JSON
        return $this->serializer->serialize($response, $tags);
    }

    /**
     * @param Request  $request
     * @param Response $response
     * @param string[] $args
     *
     * @return Response
     */
    public function getTagAction(Request $request, Response $response, array $args): Response
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
     * @param Request  $request
     * @param Response $response
     * @param string[] $args
     *
     * @return Response
     */
    public function createTagAction(Request $request, Response $response, array $args): Response
    {
        // TODO: add new tag

        // Return empty response with 201 Created code
        return $this->serializer->serialize($response, [], StatusCode::HTTP_CREATED);
    }
}
