<?php

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
     * @param $renderer
     */
    public function __construct(PhpRenderer $renderer)
    {
        $this->renderer = $renderer;
    }

    public function indexAction(Request $request, Response $response, array $args)
    {
        // Render index view
        return $this->renderer->render($response, 'index.phtml', $args);
    }
}
