<?php
// Routes

use Slim\Http\Request;
use Slim\Http\Response;

$this->get('/[{name}]', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});

$this->group('/api', function () {
    // Tasks API
    $this->get('/tasks', function (Request $request, Response $response, array $args) {
        // TODO: fetch list of tasks
        $tasks = [
            [
                'id'    => 1,
                'title' => 'Task 1',
            ],
            [
                'id'    => 2,
                'title' => 'Task 2',
            ],
        ];

        // Return response as JSON
        return $response->withJson(['tasks' => $tasks]);
    });

    $this->get('/tasks/{task_id}', function (Request $request, Response $response, array $args) {
        // TODO: fetch task by ID
        $task = [
            'id'    => $args['task_id'],
            'title' => 'Task ' . $args['task_id'],
        ];

        // Return response as JSON
        return $response->withJson(['task' => $task]);
    });

    $this->post('/tasks', function (Request $request, Response $response, array $args) {
        // TODO: save new task
        $task = $request->getParsedBody();
        $task = array_merge(['id' => '1'], $task);

        // Return response as JSON with 201 Created code
        return $response->withJson(['task' => $task], 201);
    });

    $this->put('/tasks/{task_id}', function (Request $request, Response $response, array $args) {
        // TODO: update existing task
        $task = $request->getParsedBody();
        $task = array_merge(['id' => $args['task_id']], $task);

        // Return response as JSON
        return $response->withJson(['task' => $task]);
    });

    $this->delete('/tasks/{task_id}', function (Request $request, Response $response, array $args) {
        // TODO: delete existing task

        // Return empty response with 204 No Content code
        return $response->withJson(null, 204);
    });

    // Categories API
    $this->get('/categories', function (Request $request, Response $response, array $args) {
        // TODO: fetch list of categories
        $categories = [];

        // Return response as JSON
        return $response->withJson(['categories' => $categories]);
    });

    $this->get('/categories/{category_id}', function (Request $request, Response $response, array $args) {
        // TODO: fetch category by ID
        $task = [
            'id'    => $args['category_id'],
            'title' => 'Category ' . $args['category_id'],
        ];

        // Return response as JSON
        return $response->withJson(['task' => $task]);
    });

    $this->post('/categories', function (Request $request, Response $response, array $args) {
        // TODO: save new category

        // Return empty response with 201 Created code
        return $response->withJson(null, 201);
    });

    $this->put('/categories/{category_id}', function (Request $request, Response $response, array $args) {
        // TODO: update existing category

        // Return empty response with 204 No Content code
        return $response->withJson(null, 204);
    });

    // Tags API
    $this->get('/tags', function (Request $request, Response $response, array $args) {
        // TODO: fetch list of available tags
        $tags = [];

        // Return response as JSON
        return $response->withJson(['tags' => $tags]);
    });

    $this->get('/tags/{tag_id}', function (Request $request, Response $response, array $args) {
        // TODO: fetch category by ID
        $task = [
            'id'    => $args['tag_id'],
            'title' => 'Tag ' . $args['tag_id'],
        ];

        // Return response as JSON
        return $response->withJson(['task' => $task]);
    });

    $this->post('/tags', function (Request $request, Response $response, array $args) {
        // TODO: add new tag

        // Return empty response with 201 Created code
        return $response->withJson(null, 201);
    });
    
})->add(function (Request $request, Response $response, callable $next) {
    $route = $request->getAttribute('route');

    // Sample log message
    $this->logger->info("Slim-Skeleton '{$route->getPattern ()}' route");

    return $next($request, $response);
});
