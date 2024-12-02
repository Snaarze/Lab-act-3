<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="h-screen w-screen bg-gray-100">

    <div class="p-8">
        <h1 class="text-3xl font-semibold mb-6">Dashboard</h1>

        {{-- Success message --}}
        <div id="successMessage" class="hidden bg-green-100 text-green-800 p-4 rounded mb-4"></div>

        {{-- Logout button with confirmation --}}
        <form action="{{ route('logout') }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to log out?')">
            @csrf
            <button type="submit" class="w-full bg-red-500 text-white py-2 rounded hover:bg-red-600 mb-6">
                Logout
            </button>
        </form>

        {{-- Create Blog Post Form --}}
        <div class="bg-white shadow-lg rounded-lg p-6 mb-6">
            <h2 class="text-2xl font-bold mb-4">Create a New Blog Post</h2>

            {{-- Unified Validation Errors --}}
            <div id="validationErrors" class="hidden bg-red-100 border border-red-400 text-red-700 p-4 rounded mb-4">
                <ul id="errorList" class="list-disc pl-5"></ul>
            </div>

            <form id="createPostForm">
                @csrf
                <div class="space-y-4">
                    {{-- Title Field --}}
                    <div>
                        <label for="title" class="block text-sm font-medium">Title</label>
                        <input type="text" name="title" id="title"
                               class="w-full border px-4 py-2 rounded focus:ring-blue-500"
                               placeholder="Enter title">
                        <p id="titleError" class="text-red-500 text-sm mt-1 hidden"></p>
                    </div>

                    {{-- Content Field --}}
                    <div>
                        <label for="content" class="block text-sm font-medium">Content</label>
                        <textarea name="content" id="content"
                                  class="w-full border px-4 py-2 rounded focus:ring-blue-500"
                                  placeholder="Enter content"></textarea>
                        <p id="contentError" class="text-red-500 text-sm mt-1 hidden"></p>
                    </div>

                    {{-- Submit Button --}}
                    <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600">
                        Create Post
                    </button>
                </div>
            </form>
        </div>

        {{-- Filter Posts Dropdown --}}
        <div class="mb-6">
            <form action="{{ route('dashboard') }}" method="GET">
                <select name="filter" class="border px-4 py-2 rounded" onchange="this.form.submit()">
                    <option value="mine" {{ $filter == 'mine' ? 'selected' : '' }}>My Posts</option>
                    <option value="all" {{ $filter == 'all' ? 'selected' : '' }}>All Posts</option>
                </select>
            </form>
        </div>

        {{-- Blog Posts List --}}
        <div class="bg-white shadow-lg rounded-lg p-6 mb-6">
            <h2 class="text-2xl font-bold mb-4">{{ $filter == 'mine' ? 'Your Blog Posts' : 'All Blog Posts' }}</h2>
            @forelse ($posts as $post)
                <div class="mb-4">
                    <h3 class="text-xl font-semibold">{{ $post->title }}</h3>
                    <p class="text-gray-600">{{ Str::limit($post->content, 100) }}</p>
                    <p class="text-sm text-gray-500">By: {{ $post->user->name }}</p>
                    <a href="{{ route('show', $post->id) }}" class="text-blue-500 hover:text-blue-600">Read More</a>
                </div>
            @empty
                <p class="text-gray-500">No posts found.</p>
            @endforelse

            {{-- Pagination Links --}}
            <div class="mt-4">
                {{ $posts->links() }}
            </div>
        </div>
    </div>

    {{-- AJAX for the Create Post Form --}}
    <script>
        $(document).ready(function () {
            $('#createPostForm').on('submit', function (e) {
                e.preventDefault(); // Prevent default form submission

                // Reset validation errors
                $('#validationErrors').addClass('hidden');
                $('#errorList').empty();
                $('#titleError, #contentError').addClass('hidden').text('');
                $('#title, #content').removeClass('border-red-500');

                const formData = {
                    title: $('#title').val(),
                    content: $('#content').val(),
                    _token: '{{ csrf_token() }}' // CSRF token for security
                };

                $.ajax({
                    type: 'POST',
                    url: '{{ route('store') }}',
                    data: formData,
                    success: function (response) {
                        // Display success message
                        $('#successMessage').removeClass('hidden').text('Blog post created successfully!');

                        // Clear form fields
                        $('#title').val('');
                        $('#content').val('');

                        // Optionally reload the posts (or fetch new data dynamically)
                        window.location.reload();
                    },
                    error: function (xhr) {
                        // Extract validation errors
                        const errors = xhr.responseJSON.errors || {};

                        // Show unified error block
                        if (Object.keys(errors).length > 0) {
                            $('#validationErrors').removeClass('hidden');
                            for (const key in errors) {
                                $('#errorList').append(`<li>${errors[key][0]}</li>`);

                                // Show specific field errors
                                if (key === 'title') {
                                    $('#titleError').removeClass('hidden').text(errors[key][0]);
                                    $('#title').addClass('border-red-500');
                                }
                                if (key === 'content') {
                                    $('#contentError').removeClass('hidden').text(errors[key][0]);
                                    $('#content').addClass('border-red-500');
                                }
                            }
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>
