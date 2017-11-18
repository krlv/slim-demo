<?php

namespace Skeleton\App\Route;

use Skeleton\App\SkeletonApp;

class TasksRoute
{
    /**
     * Register Tasks API routes
     *
     * @param SkeletonApp $app
     */
    public function __invoke(SkeletonApp $app)
    {
        $app->get('', 'tasks_controller:getTasksAction');
        $app->get('/{task_id}', 'tasks_controller:getTaskAction');
        $app->post('', 'tasks_controller:createTaskAction');
        $app->put('/{task_id}', 'tasks_controller:updateTaskAction');
        $app->delete('/{task_id}', 'tasks_controller:deleteTaskAction');
    }
}
