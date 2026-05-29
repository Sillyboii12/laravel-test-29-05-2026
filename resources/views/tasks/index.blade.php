<x-layout>
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold">All Tasks</h2>
        <a href="{{ route('tasks.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Add New Task</a>
    </div>

    <ul class="bg-white rounded shadow">
        @forelse ($tasks as $task)
            <li class="border-b p-4 flex justify-between items-center">
                <div class="flex items-center">
                    <a href="{{ route('tasks.edit', $task) }}" class="ml-2 {{ $task->isCompleted() ? 'line-through text-gray-400' : '' }}">
                        {{ $task->title }}
                    </a>
                    <span class="ml-2 text-xs bg-gray-200 px-2 py-1 rounded text-gray-600">{{ ucfirst(str_replace('_', ' ', $task->status)) }}</span>
                </div>

                <div class="flex gap-4">
                    <a href="{{ route('tasks.edit', $task->id) }}" class="text-blue-500">Edit</a>

                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" onsubmit="return confirm('Delete this task?')">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-500">Delete</button>
                    </form>
                </div>
            </li>
        @empty
            <li class="p-4 text-center text-gray-500">No tasks yet.</li>
        @endforelse
    </ul>
</x-layout>
