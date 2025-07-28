<?php

namespace App\Livewire\Tasks;

use App\DTOs\TaskData;
use App\Models\Task;
use App\Services\Task\TaskServiceInterface;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreTaskRequest;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public ?int $taskId = null;
    public string $title = '';
    public string $description = '';
    public $perPage = 3;

    public function save(TaskServiceInterface $service) {

        $validated = $this->validate(
            (new StoreTaskRequest())->rules(),
            (new StoreTaskRequest())->messages()
        );

        $data = new TaskData($validated);

        if ($this->taskId) {
            $task = Task::find($this->taskId);
            $service->update($task, $data);
            session()->flash('message', 'Task updated!');
        } else {
            $service->store($data);
            session()->flash('message', 'Task created!');
        }

        $this->reset(['taskId', 'title', 'description']);
         $this->dispatch('show-toast');
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
    }

    public function loadMore()
    {
        $this->perPage += 3;
    }

    public function render()
    {
        $tasks = Task::latest()->paginate($this->perPage);
        return view('livewire.tasks.index', [
            'taskId' => $this->taskId,
            'tasks' => $tasks,
            'hasMorePages' => $tasks->hasMorePages(),
        ]);
    }
}
