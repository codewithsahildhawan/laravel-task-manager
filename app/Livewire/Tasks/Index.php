<?php

namespace App\Livewire\Tasks;

use App\DTOs\TaskData;
use App\Models\Task;
use App\Services\Task\TaskServiceInterface;
use Livewire\Component;

class Index extends Component
{
    public ?int $taskId = null;
    public string $title = '';
    public string $description = '';
    public $tasks;

    public function mount()
    {
        // For listing or initial setup
        $this->tasks = Task::all();
    }
    
    public function save(TaskServiceInterface $service) {
        $this->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $data = new TaskData([
            'title' => $this->title,
            'description' => $this->description,
        ]);

        if ($this->taskId) {
            $task = Task::find($this->taskId);
            $service->update($task, $data);
            session()->flash('message', 'Task updated!');
        } else {
            $service->store($data);
            session()->flash('message', 'Task created!');
        }

        $this->reset(['taskId', 'title', 'description']);
        $this->tasks = Task::all(); // refresh list
    }

    public function edit($id) {
        $task = Task::findOrFail($id);
        $this->taskId = $task->id;
        $this->title = $task->title;
        $this->description = $task->description;
    }

    public function delete(TaskServiceInterface $service, $id) {
        $service->delete(Task::findOrFail($id));
        session()->flash('message', 'Task deleted!');
        $this->tasks = Task::all();
    }

    public function render()
    {
        return view('livewire.tasks.index', [
            'taskId' => $this->taskId,
            'tasks' => Task::all(),
        ]);
    }
}
