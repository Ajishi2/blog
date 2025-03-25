<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post | Oceanic</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/@material-tailwind/html@latest/styles/material-tailwind.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        oceanic: {
                            deep: '#5D768B',
                            sand: '#C8B39B',
                            driftwood: '#E3C9A4',
                            shell: '#F2D9C7',
                            breeze: '#F8EFE5',
                            slate: '#3A4A5A'
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <style>
        body {
            background-color: #F8EFE5;
            font-family: 'Inter', sans-serif;
        }
        .editor-card {
            background: white;
            box-shadow: 0 25px 50px -12px rgba(93, 118, 139, 0.08);
            border-radius: 12px;
            border: 1px solid rgba(93, 118, 139, 0.1);
        }
        .nav-pill {
            position: relative;
        }
        .nav-pill::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 100%;
            height: 2px;
            background: #5D768B;
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }
        .nav-pill:hover::after {
            transform: scaleX(1);
        }
        .btn-primary {
            background-color: #5D768B;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .btn-primary:hover {
            background-color: #3A4A5A;
            transform: translateY(-1px);
            box-shadow: 0 10px 15px -3px rgba(93, 118, 139, 0.2);
        }
        .input-field {
            transition: all 0.3s ease;
            border: 1px solid rgba(93, 118, 139, 0.2);
        }
        .input-field:focus {
            border-color: #5D768B;
            box-shadow: 0 0 0 3px rgba(93, 118, 139, 0.1);
        }
    </style>
</head>
<body class="min-h-screen bg-oceanic-breeze">
    <!-- Minimal Header -->
    <header class="bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex justify-between h-20 items-center">
                <a href="/" class="text-2xl font-semibold text-oceanic-slate tracking-tight">Oceanic</a>
                <nav class="hidden md:flex space-x-8">
                    <a href="#" class="text-oceanic-deep/90 hover:text-oceanic-deep nav-pill font-medium">Dashboard</a>
                    <a href="#" class="text-oceanic-deep/90 hover:text-oceanic-deep nav-pill font-medium">Profile</a>
                    <a href="#" class="text-oceanic-deep/90 hover:text-oceanic-deep nav-pill font-medium">Settings</a>
                </nav>
            </div>
        </div>
    </header>

    <!-- Editor Content -->
    <main class="max-w-4xl mx-auto px-6 py-12">
        <div class="editor-card overflow-hidden">
            <!-- Editor Header -->
            <div class="px-8 py-6 border-b border-gray-100 flex items-center justify-between">
                <div>
                    <a href="/" class="inline-flex items-center text-oceanic-deep/80 hover:text-oceanic-deep transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                        </svg>
                        Back to posts
                    </a>
                </div>
                <h1 class="text-xl font-semibold text-oceanic-slate">Edit Post</h1>
                <div class="w-24"></div> <!-- Spacer for balance -->
            </div>
            
            <!-- Editor Form -->
            <div class="p-8">
                <form action="/edit-post/{{ $post->id }}" method="POST" class="space-y-8">
                    @csrf
                    @method('PUT')
                    
                    <div class="space-y-2">
                        <label for="title" class="block text-sm font-medium text-oceanic-slate">Title</label>
                        <input type="text" id="title" name="title" value="{{ $post->title }}" required
                            class="input-field w-full px-5 py-3 rounded-lg bg-white focus:outline-none focus:ring-0">
                    </div>
                    
                    <div class="space-y-2">
                        <label for="body" class="block text-sm font-medium text-oceanic-slate">Content</label>
                        <textarea id="body" name="body" rows="10" required
                            class="input-field w-full px-5 py-3 rounded-lg bg-white focus:outline-none focus:ring-0">{{ $post->body }}</textarea>
                    </div>
                    
                    <div class="flex items-center justify-end space-x-4 pt-4">
                        <a href="/" class="px-6 py-2.5 rounded-lg text-oceanic-deep/80 hover:text-oceanic-deep font-medium transition-colors">
                            Discard
                        </a>
                        <button type="submit" class="btn-primary px-7 py-2.5 rounded-lg text-white font-medium">
                            Update Post
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
    
    <!-- Minimal Footer -->
    <footer class="bg-white border-t border-gray-100 mt-16">
        <div class="max-w-7xl mx-auto px-6">
            <div class="py-8 flex flex-col md:flex-row justify-between items-center">
                <div class="text-sm text-oceanic-deep/70 mb-4 md:mb-0">
                    &copy; 2024 Oceanic. All rights reserved.
                </div>
                <div class="flex space-x-6">
                    <a href="#" class="text-oceanic-deep/70 hover:text-oceanic-deep transition-colors">Terms</a>
                    <a href="#" class="text-oceanic-deep/70 hover:text-oceanic-deep transition-colors">Privacy</a>
                    <a href="#" class="text-oceanic-deep/70 hover:text-oceanic-deep transition-colors">Contact</a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>