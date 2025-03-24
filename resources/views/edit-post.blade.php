<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post | SocialPosts</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            200: '#bae6fd',
                            300: '#7dd3fc',
                            400: '#38bdf8',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                            800: '#075985',
                            900: '#0c4a6e',
                        }
                    },
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <style>
        body {
            background-color: #f8fafc;
            font-family: 'Poppins', sans-serif;
        }
        .form-card {
            background: linear-gradient(145deg, #ffffff, #f5f7fa);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.01);
        }
        .btn-primary {
            background: linear-gradient(to right, #0284c7, #0ea5e9);
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background: linear-gradient(to right, #0369a1, #0284c7);
            box-shadow: 0 4px 12px rgba(2, 132, 199, 0.25);
        }
    </style>
</head>
<body class="min-h-screen">
    <header class="bg-white border-b border-gray-200">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="/" class="text-2xl font-bold text-primary-600">SocialPosts</a>
                </div>
            </div>
        </div>
    </header>

    <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="form-card rounded-xl overflow-hidden border border-gray-100">
            <div class="bg-primary-600 px-6 py-4">
                <div class="flex items-center">
                    <a href="/" class="text-white hover:text-primary-100 mr-4 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                        </svg>
                    </a>
                    <h1 class="text-xl font-bold text-white">Edit Post</h1>
                </div>
            </div>
            
            <div class="bg-white p-6">
                <form action="/edit-post/{{ $post->id }}" method="POST" class="space-y-5">
                    @csrf
                    @method('PUT')
                    
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                        <input type="text" id="title" name="title" value="{{ $post->title }}" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                    </div>
                    
                    <div>
                        <label for="body" class="block text-sm font-medium text-gray-700 mb-1">Content</label>
                        <textarea id="body" name="body" rows="8" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent">{{ $post->body }}</textarea>
                    </div>
                    
                    <div class="flex items-center justify-between pt-2">
                        <a href="/" class="px-5 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg text-gray-700 font-medium transition-all">
                            Cancel
                        </a>
                        <button type="submit" class="btn-primary px-6 py-2 rounded-lg text-white font-medium transition-all">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
    
    <footer class="bg-white border-t border-gray-200 mt-12">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="py-6 text-center text-sm text-gray-500">
                &copy; 2024 SocialPosts. All rights reserved.
            </div>
        </div>
    </footer>
</body>
</html>

