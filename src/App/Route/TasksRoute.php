<?php

declare(strict_types=1);

namespace Skeleton\App\Route;

use Slim\Interfaces\RouteCollectorProxyInterface;

class TasksRoute
{
    /**
     * Register Tasks API routes.
     *
     * @param RouteCollectorProxyInterface $app
     */
    public function __invoke(RouteCollectorProxyInterface $app): void
    {
        $app->get('', 'tasks_controller:getTasksAction');
        $app->get('/{task_id}', 'tasks_controller:getTaskAction');
        $app->post('', 'tasks_controller:createTaskAction');
        $app->put('/{task_id}', 'tasks_controller:updateTaskAction');
        $app->delete('/{task_id}', 'tasks_controller:deleteTaskAction');
    }
}
