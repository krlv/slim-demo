<?php

declare(strict_types=1);

namespace Skeleton\Application\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\PhpRenderer;

class HomeController
{
    private PhpRenderer $renderer;

    public function __construct(PhpRenderer $renderer)
    {
        $this->renderer = $renderer;
    }

    public function indexAction(Request $request, Response $response, array $args): Response
    {
        // Render index view
        return $this->renderer->render($response, 'index.phtml', $args);
    }
}
