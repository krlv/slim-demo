<?php

declare(strict_types=1);

namespace Skeleton\App\Controller;

use Psr\Http\Message\ResponseInterface;
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
     * @return ResponseInterface
     */
    public function indexAction(Request $request, Response $response, array $args): ResponseInterface
    {
        // Render index view
        return $this->renderer->render($response, 'index.phtml', $args);
    }
}
