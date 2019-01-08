<?php

declare(strict_types=1);

namespace Skeleton\App\Controller;

use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Views\PhpRenderer;

class HomeController
{
    /**
     * @var PhpRenderer
     */
    private $renderer;

    /**
     * @param PhpRenderer $renderer
     */
    public function __construct(PhpRenderer $renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * @param Request  $request
     * @param Response $response
     * @param string[] $args
     *
     * @return Response
     */
    public function indexAction(Request $request, Response $response, array $args): Response
    {
        // Render index view
        return $this->renderer->render($response, 'index.phtml', $args);
    }
}
