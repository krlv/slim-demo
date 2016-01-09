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

    $this->put('/tasks/{task_id}', function ($request, $response, $args) {
        // Sample log message
        $this->logger->info("Slim-Skeleton '/api/tasks/{task_id}' route");

        // TODO: update existing task

        // Return empty response with 204 No Content code
        return $response->withJson(null, 204);
    });

    $this->get('/categories', function ($request, $response, $args) {
        // Sample log message
        $this->logger->info("Slim-Skeleton '/api/categories' route");

        // TODO: fetch list of categories
        $categories = [];

        // Return response as JSON
        return $response->withJson(['categories' => $categories]);
    });

    $this->get('/categories/{category_id}', function ($request, $response, $args) {
        // Sample log message
        $this->logger->info("Slim-Skeleton '/categories/{category_id}' route");

        // TODO: fetch category by ID
        $task = [
            'id'    => $args['category_id'],
            'title' => 'Category ' . $args['category_id'],
        ];

        // Return response as JSON
        return $response->withJson(['task' => $task]);
    });

    $this->post('/categories', function ($request, $response, $args) {
        // Sample log message
        $this->logger->info("Slim-Skeleton '/api/categories' route");

        // TODO: save new category

        // Return empty response with 201 Created code
        return $response->withJson(null, 201);
    });

    $this->put('/categories/{category_id}', function ($request, $response, $args) {
        // Sample log message
        $this->logger->info("Slim-Skeleton '/api/categories/{category_id}' route");

        // TODO: update existing category

        // Return empty response with 204 No Content code
        return $response->withJson(null, 204);
    });
});
