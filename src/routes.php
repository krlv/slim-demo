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

        // Return response as JSON
        return $response->withJson(['tasks' => $tasks]);
    });

    $this->get('/tasks/{task_id}', function ($request, $response, $args) {
        // Sample log message
        $this->logger->info("Slim-Skeleton '/api/tasks/{task_id}' route");

        // TODO: fetch task by ID
        $task = [
            'id'    => $args['task_id'],
            'title' => 'Task ' . $args['task_id'],
        ];

        // Return response as JSON
        return $response->withJson(['task' => $task]);
    });

    $this->post('/tasks', function ($request, $response, $args) {
        // Sample log message
        $this->logger->info("Slim-Skeleton '/api/tasks' route");

        // TODO: save new task

        // Return empty response with 201 Created code
        return $response->withJson(null, 201);
    });
});
