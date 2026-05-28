<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">

    <header class="mb-8">
        <h1 class="text-3xl font-bold"><a href="{{ route('tasks.index') }}">Task Manager</a></h1>
    </header>

    <main>
        @if (session('success'))
            <div class="bg-green-200 p-4 mb-4 rounded text-green-700">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-200 p-4 mb-4 rounded text-red-700">
                <ul class="list-disc ml-5">
                    @foreach ($errors->all() as $error)
                    @endforeach
                </ul>
            </div>
        @endif

        {{ $slot }}
    </main>

</body>
</html>
