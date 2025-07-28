<div class="p-4 max-w-2xl mx-auto">
    @if (session()->has('message'))
        <div class="bg-green-200 text-green-800 p-2 rounded mb-4">{{ session('message') }}</div>
    @endif

    <form wire:submit.prevent="save" class="mb-4 space-y-4">
        <input type="text" wire:model="title" class="w-full border rounded p-2" placeholder="Title">
        @error('title') <div class="text-red-500">{{ $message }}</div> @enderror

        <textarea wire:model="description" class="w-full border rounded p-2" placeholder="Description"></textarea>

        <button class="bg-blue-500 text-white px-4 py-2 rounded" type="submit">
            {{ $taskId ? 'Update' : 'Create' }} Task
        </button>
    </form>

    <ul class="space-y-2">
        @foreach($tasks as $task)
            <li class="flex justify-between items-center bg-gray-100 p-2 rounded">
                <div>
                    <strong>{{ $task->title }}</strong><br>
                    <small>{{ $task->description }}</small>
                </div>
                <div class="space-x-2">
                    <button wire:click="edit({{ $task->id }})" class="text-blue-500">Edit</button>
                    <button wire:click="delete({{ $task->id }})" class="text-red-500">Delete</button>
                </div>
            </li>
        @endforeach
    </ul>
</div>
