<?php

namespace App\Services\Task;
use App\DTOs\TaskData;
use App\Models\Task;

class TaskService implements TaskServiceInterface {
    
    public  function store(TaskData $taskData): Task {
        return Task::create([
            'title' => $taskData->title,
            'description' => $taskData->description,
        ]);
    }

    public function update(Task $task, TaskData $taskData): Task {
        $task->update([
            'title' => $taskData->title,
            'description' => $taskData->description,
        ]);
        return $task;
    }

    function delete(Task $task): void {
        $task->delete();
    }
}
