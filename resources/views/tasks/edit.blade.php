<x-layout>
    <h2 class="text-xl font-semibold mb-4">Edit Task</h2>

    <form action="{{ route('tasks.update', $task->id) }}" method="POST" class="bg-white p-6 rounded shadow max-w-lg">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block mb-1">Title</label>
            <input type="text" name="title" value="{{ $task->title }}" class="w-full border p-2 rounded">
        </div>

        <div class="mb-4">
            <label class="block mb-1">Description</label>
            <textarea name="description" class="w-full border p-2 rounded" rows="3">{{ $task->description }}</textarea>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update Task</button>
        <a href="{{ route('tasks.index') }}" class="ml-4 text-gray-500">Cancel</a>
    </form>
</x-layout>
