<x-layout>
    <h2 class="text-xl font-semibold mb-4">Create New Task</h2>

    <form action="{{ route('tasks.store') }}" method="POST" class="bg-white p-6 rounded shadow max-w-lg">
        @csrf

        <div class="mb-4">
            <label class="block mb-1">Title</label>
            <input type="text" name="title" class="w-full border p-2 rounded">
        </div>

        <div class="mb-4">
            <label class="block mb-1">Description</label>
            <textarea name="description" class="w-full border p-2 rounded" rows="3"></textarea>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save Task</button>
        <a href="{{ route('tasks.index') }}" class="ml-4 text-gray-500">Cancel</a>
    </form>
</x-layout>
