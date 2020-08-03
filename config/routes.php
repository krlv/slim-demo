<?php

declare(strict_types=1);

use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return static function (App $app) {
    // Web routes
    $app->get('/[{name}]', 'home_controller:indexAction');

    // API routes
    $app->group('/api', function (Group $group): void {
        // Lists API
        $group->get('/lists', 'lists_controller:getListsAction');
        $group->get('/lists/{list_id}', 'lists_controller:getListAction');
        $group->post('/lists', 'lists_controller:createListAction');
        $group->put('/lists/{list_id}', 'lists_controller:updateListAction');
        $group->delete('/lists/{list_id}', 'lists_controller:deleteListAction');

        // List's Tasks API
        $group->get('/lists/{list_id}/tasks', 'tasks_controller:getTasksAction');
        $group->get('/lists/{list_id}/tasks/{task_id}', 'tasks_controller:getTaskAction');
        $group->post('/lists/{list_id}/tasks', 'tasks_controller:createTaskAction');
        $group->put('/lists/{list_id}/tasks/{task_id}', 'tasks_controller:updateTaskAction');
        $group->delete('/lists/{list_id}/tasks/{task_id}', 'tasks_controller:deleteTaskAction');

        // Tags API
        $group->get('/tags', 'tags_controller:getTagsAction');
        $group->get('/tags/{tag_id}', 'tags_controller:getTagAction');
        $group->post('/tags', 'tags_controller:createTagAction');
    });
};
