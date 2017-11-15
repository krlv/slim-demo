<?php
// Routes

$this->group('', function () {
    $this->get('/[{name}]', 'home_controller:indexAction');
});

$this->group('/api', function () {
    // Tasks API
    $this->get('/tasks', 'tasks_controller:getTasksAction');
    $this->get('/tasks/{task_id}', 'tasks_controller:getTaskAction');
    $this->post('/tasks', 'tasks_controller:createTaskAction');
    $this->put('/tasks/{task_id}', 'tasks_controller:updateTaskAction');
    $this->delete('/tasks/{task_id}', 'tasks_controller:deleteTaskAction');

    // Categories API
    $this->get('/categories', 'categories_controller:getCategoriesAction');
    $this->get('/categories/{category_id}', 'categories_controller:getCategoryAction');
    $this->post('/categories', 'categories_controller:createCategoryAction');
    $this->put('/categories/{category_id}', 'categories_controller:updateCategoryAction');

    // Tags API
    $this->get('/tags', 'tags_controller:getTagsAction');
    $this->get('/tags/{tag_id}', 'tags_controller:getTagAction');
    $this->post('/tags', 'tags_controller:createTagAction');
});
