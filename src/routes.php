<?php
// Routes

$app->get('/[{name}]', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});

$app->group('/api', function () {
    $this->get('/tasks', function ($request, $response, $args) {
        // Sample log message
        $this->logger->info("Slim-Skeleton '/api/tasks' route");

        // TODO: fetch list of tasks
        $tasks = [];

        // Render index view
        return $response->withJson(['tasks' => $tasks]);
    });
});
