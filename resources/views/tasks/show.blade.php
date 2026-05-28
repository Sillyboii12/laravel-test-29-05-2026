<x-layout>
    <div class="bg-white p-6 rounded shadow max-w-2xl">
        <h2 class="text-2xl font-bold mb-2">{{ $task->title }}</h2>
        
        <p class="text-gray-600 mb-4">
            Status: 
            <form action="{{ route('tasks.update-status', $task->id) }}" method="POST" class="inline">
                @csrf
                @method('PATCH')
                <select name="status" class="border rounded p-1">
                    <option value="pending" {{ $task->status === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="in_progress" {{ $task->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="completed" {{ $task->status === 'completed' ? 'selected' : '' }}>Completed</option>
                </select>
                <button type="submit" class="bg-blue-500 text-white px-2 py-1 rounded text-sm ml-1">Update Status</button>
            </form>
            @if($task->isCompleted())
                <span class="text-sm text-gray-500">({{ $task->completed_at->format('M d, Y') }})</span>
            @endif
        </p>

        <div class="border-t pt-4 mb-6">
            <p>{{ $task->description ?: 'No description provided.' }}</p>
        </div>

        <div class="flex gap-4">
            <a href="{{ route('tasks.edit', $task->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded">Edit</a>
            <a href="{{ route('tasks.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Back to List</a>
        </div>
    </div>
</x-layout>
