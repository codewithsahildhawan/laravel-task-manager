<?php

namespace App\Services\Task;
use App\DTOs\TaskData;
use App\Models\Task;

interface TaskServiceInterface {
    /**
     * store a new task.
     *
     * @param TaskData $taskData
     * @return Task
     */
    public function store (TaskData $taskData): Task;
    public  function update (  Task $task, TaskData $taskData): Task;
    public function delete (Task $task): void;
}
