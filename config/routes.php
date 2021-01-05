<?php

declare(strict_types=1);

use Skeleton\Application\Controller;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return static function (App $app) {
    // Web routes
    $app->get('/[{name}]', Controller\HomeController::class . ':indexAction');

    // API routes
    $app->group('/api', function (Group $group): void {
        // Lists API
        $group->get('/lists', Controller\ListsController::class . ':getListsAction');
        $group->get('/lists/{list_id}', Controller\ListsController::class . ':getListAction');
        $group->post('/lists', Controller\ListsController::class . ':createListAction');
        $group->put('/lists/{list_id}', Controller\ListsController::class . ':updateListAction');
        $group->delete('/lists/{list_id}', Controller\ListsController::class . ':deleteListAction');

        // List's Tasks API
        $group->get('/lists/{list_id}/tasks', Controller\TasksController::class . ':getTasksAction');
        $group->get('/lists/{list_id}/tasks/{task_id}', Controller\TasksController::class . ':getTaskAction');
        $group->post('/lists/{list_id}/tasks', Controller\TasksController::class . ':createTaskAction');
        $group->put('/lists/{list_id}/tasks/{task_id}', Controller\TasksController::class . ':updateTaskAction');
        $group->delete('/lists/{list_id}/tasks/{task_id}', Controller\TasksController::class . ':deleteTaskAction');

        // Tags API
        $group->get('/tags', Controller\TagsController::class . ':getTagsAction');
        $group->post('/tags', Controller\TagsController::class . ':createTagAction');
    });
};
