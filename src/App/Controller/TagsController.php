<?php

namespace Skeleton\App\Controller;

use Slim\Http\Request;
use Slim\Http\Response;

class TagsController
{
    public function getTags(Request $request, Response $response, array $args)
    {
        // TODO: fetch list of available tags
        $tags = [];

        // Return response as JSON
        return $response->withJson(['tags' => $tags]);
    }

    public function getTag(Request $request, Response $response, array $args)
    {
        // TODO: fetch tag by ID
        $tags = [
            'id'    => $args['tag_id'],
            'title' => 'Tag ' . $args['tag_id'],
        ];

        // Return response as JSON
        return $response->withJson(['tags' => $tags]);
    }

    public function createTag(Request $request, Response $response, array $args)
    {
        // TODO: add new tag

        // Return empty response with 201 Created code
        return $response->withJson(null, 201);
    }
}
