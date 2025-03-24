<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Social Platform</title>
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
        .auth-card {
            background: linear-gradient(145deg, #ffffff, #f5f7fa);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.01);
        }
        .post-card {
            transition: all 0.2s ease;
        }
        .post-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.04);
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
                    <span class="text-2xl font-bold text-primary-600">SocialPosts</span>
                </div>
            </div>
        </div>
    </header>

    <main class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        @auth
            <div class="bg-white rounded-xl shadow-sm p-6 mb-8 border border-gray-100">
                <div class="flex items-center justify-between mb-6">
                    <h1 class="text-2xl font-bold text-gray-800">Welcome back!</h1>
                    <form action="/logout" method="POST">
                        @csrf
                        <button class="px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg text-gray-700 font-medium transition-all">
                            Log out
                        </button>
                    </form>
                </div>
                <p class="text-gray-600 mb-4">You are logged in successfully.</p>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-6 mb-8 border border-gray-100">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Create a new post</h2>
                <form action="/create-post" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                        <input type="text" id="title" name="title" placeholder="Enter post title" 
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                    </div>
                    <div>
                        <label for="body" class="block text-sm font-medium text-gray-700 mb-1">Content</label>
                        <textarea id="body" name="body" placeholder="Write your post content here..." rows="4"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent"></textarea>
                    </div>
                    <div>
                        <button class="btn-primary px-5 py-3 rounded-lg text-white font-medium w-full sm:w-auto">
                            Save post
                        </button>
                    </div>
                </form>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <h2 class="text-xl font-bold text-gray-800 mb-6">All Posts</h2>
                
                @foreach($posts as $post)
                    <div class="post-card bg-gray-50 rounded-lg p-5 mb-4 border border-gray-100">
                        <div class="flex justify-between items-start mb-3">
                            <h3 class="text-lg font-semibold text-gray-800">{{ $post['title'] }}</h3>
                            <span class="text-sm text-gray-500 bg-gray-100 px-2 py-1 rounded-full">by {{ $post->user->name }}</span>
                        </div>
                        <p class="text-gray-700 mb-4">{{ $post['body'] }}</p>
                        <div class="flex items-center justify-between mt-2 pt-3 border-t border-gray-200">
                            <a href="/edit-post/{{ $post->id }}" class="text-primary-600 hover:text-primary-800 font-medium flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Edit
                            </a>
                            <form action="/delete-post/{{ $post->id }}" method="POST">
                                @csrf
                                @method("DELETE")
                                <button class="px-3 py-1 bg-red-50 hover:bg-red-100 text-red-600 rounded-lg font-medium transition-all flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="max-w-4xl mx-auto">
                <div class="text-center mb-10">
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">Welcome to SocialPosts</h1>
                    <p class="text-gray-600 max-w-2xl mx-auto">Join our community to share your thoughts and connect with others.</p>
                </div>
                
                <div class="auth-card rounded-2xl overflow-hidden">
                    <div class="md:flex">
                        <!-- Left side - Login -->
                        <div class="w-full md:w-1/2 p-8 bg-white">
                            <div class="max-w-sm mx-auto">
                                <h2 class="text-2xl font-bold text-gray-800 mb-6">Login</h2>
                                <form action="/login" method="post" class="space-y-4">
                                    @csrf
                                    <div>
                                        <label for="loginname" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                                        <input id="loginname" name="loginname" type="text" placeholder="Enter your username" 
                                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                                    </div>
                                    <div>
                                        <label for="loginpassword" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                                        <input id="loginpassword" name="loginpassword" type="password" placeholder="Enter your password" 
                                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                                    </div>
                                    <div class="pt-2">
                                        <button class="btn-primary w-full px-5 py-3 rounded-lg text-white font-medium transition-all">
                                            Log in
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        
                        <!-- Right side - Register -->
                        <div class="w-full md:w-1/2 p-8 bg-gray-50 border-t md:border-t-0 md:border-l border-gray-200">
                            <div class="max-w-sm mx-auto">
                                <h2 class="text-2xl font-bold text-gray-800 mb-6">Register</h2>
                                <form action="/register" method="post" class="space-y-4">
                                    @csrf
                                    <div>
                                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                                        <input id="name" name="name" type="text" placeholder="Enter your full name" 
                                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                                    </div>
                                    <div>
                                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                        <input id="email" name="email" type="email" placeholder="Enter your email address" 
                                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                                    </div>
                                    <div>
                                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                                        <input id="password" name="password" type="password" placeholder="Create a password" 
                                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                                    </div>
                                    <div class="pt-2">
                                        <button class="btn-primary w-full px-5 py-3 rounded-lg text-white font-medium transition-all">
                                            Register
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endauth
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
