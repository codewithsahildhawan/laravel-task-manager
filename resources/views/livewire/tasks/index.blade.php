
<div class="max-w-3xl mx-auto p-6 bg-white shadow-lg rounded-xl space-y-6">
    <h2 class="text-2xl font-semibold text-gray-800">Create / Edit Task</h2>
    
    <form wire:submit.prevent="save">
        <div class="space-y-4">
            
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                <input wire:model.defer="title" id="title" type="text" class="mt-1 block w-full px-4 py-2 border-gray-300 rounded-xl shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
                @error('title') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>
            
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea wire:model.defer="description" id="description" rows="3" class="mt-1 block w-full border-gray-300 rounded-xl shadow-sm focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                @error('description') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>
            
            <div class="text-right">
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-semibold rounded-xl shadow hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
                    {{ $taskId ? 'Update Task' : 'Create Task' }}
                </button>
            </div>
        </div>
    </form>
    
    {{-- Toast --}}
    {{-- Toast with Countdown and Spinner --}}
    <div
    x-data="{ show: false, seconds: 10 }"
    x-init="
        @this.on('show-toast', () => {
            show = true;
            seconds = 10;
            let timer = setInterval(() => {
                seconds--;
                if (seconds <= 0) {
                    clearInterval(timer);
                    show = false;
                }
            }, 1000);
        });
    "
    x-show="show"
    x-transition
    class="fixed top-6 right-6 z-50 bg-green-600 text-white px-6 py-3 rounded-xl shadow-lg flex items-center space-x-4"
    style="display: none;"
    >
    {{-- Spinner --}}
    <svg class="w-5 h-5 animate-spin text-white" fill="none" viewBox="0 0 24 24">
        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
    </svg>
    
    {{-- Message --}}
    <div class="text-sm font-medium">
        {{ session('message') }}
    </div>
    
    {{-- Countdown --}}
    <div class="text-xs opacity-80 font-mono">Hiding in <span x-text="seconds"></span>s</div>
</div>

{{-- Task List --}}
<div class="mt-6">
    <h3 class="text-lg font-semibold text-gray-700 mb-3">🗂️ Tasks</h3>
    <ul class="space-y-3">
        @foreach ($tasks as $task)
        <li class="bg-gray-50 p-4 rounded-lg flex justify-between items-start shadow-sm hover:shadow-md transition">
            <div>
                <h4 class="font-bold text-gray-800">{{ $task->title }}</h4>
                <p class="text-gray-600 text-sm">{{ $task->description }}</p>
            </div>
            <div class="flex items-center space-x-2">
                <button wire:click="edit({{ $task->id }})" class="text-blue-500 hover:text-blue-700">✏️</button>
                <button wire:click="delete({{ $task->id }})" class="text-red-500 hover:text-red-700">🗑️</button>
            </div>
        </li>
        @endforeach
    </ul>
    
    @if ($tasks->hasPages())
    <div class="mt-4">
        {{ $tasks->links() }}
    </div>
    @endif
</div>
