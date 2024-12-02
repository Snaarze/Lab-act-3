<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-screen w-screen bg-gray-100">

    <div class="p-8">
        <h1 class="text-3xl font-semibold mb-6">Dashboard</h1>

        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('logout') }}" method="POST" class="inline">
            @csrf
            <button type="submit" class="w-full bg-red-500 text-white py-2 rounded hover:bg-red-600 mb-6">
                Logout
            </button>
        </form>

        <div class="bg-white shadow-lg rounded-lg p-6 mb-6">
            <h2 class="text-2xl font-bold mb-4">Create a New Blog Post</h2>
            <form method="POST" action="{{ route('store') }}">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label for="title" class="block text-sm font-medium">Title</label>
                        <input type="text" name="title" id="title" class="w-full border px-4 py-2 rounded focus:ring-blue-500" required placeholder="Enter title">
                    </div>
                    <div>
                        <label for="content" class="block text-sm font-medium">Content</label>
                        <textarea name="content" id="content" class="w-full border px-4 py-2 rounded focus:ring-blue-500" required placeholder="Enter content"></textarea>
                    </div>
                    <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600">
                        Create Post
                    </button>
                </div>
            </form>
        </div>

        <div class="mb-6">
            <form action="{{ route('dashboard') }}" method="GET">
                <select name="filter" class="border px-4 py-2 rounded" onchange="this.form.submit()">
                    <option value="mine" {{ $filter == 'mine' ? 'selected' : '' }}>My Posts</option>
                    <option value="all" {{ $filter == 'all' ? 'selected' : '' }}>All Posts</option>
                </select>
            </form>
        </div>
        <div class="bg-white shadow-lg rounded-lg p-6">
            <h2 class="text-2xl font-bold mb-4">{{ $filter == 'mine' ? 'Your Blog Posts' : 'All Blog Posts' }}</h2>
            @foreach ($posts as $post)
                <div class="mb-4">
                    <h3 class="text-xl font-semibold">{{ $post->title }}</h3>
                    <p class="text-gray-600">{{ Str::limit($post->content, 100) }}</p>
                    <p class="text-sm text-gray-500">By: {{ $post->user->name }}</p>
                    <a href="{{ route('show', $post->id) }}" class="text-blue-500 hover:text-blue-600">Read More</a>
                </div>
            @endforeach
        </div>
    </div>

</body>
</html>
