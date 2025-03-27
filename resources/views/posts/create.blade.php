<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Same head content as edit-post.blade.php -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Post | Oceanic</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Include the same styles as edit-post.blade.php -->
</head>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Post | Oceanic</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #F8EFE5;
            font-family: 'Inter', sans-serif;
        }
        .editor-card {
            background: white;
            border-radius: 0.5rem;
            box-shadow: 0 1px 3px rgba(93, 118, 139, 0.05);
        }
        .input-field {
            transition: all 0.3s ease;
            border: 1px solid rgba(93, 118, 139, 0.2);
        }
        .input-field:focus {
            border-color: #5D768B;
            box-shadow: 0 0 0 3px rgba(93, 118, 139, 0.1);
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
    </style>
</head>
    </header>

    <!-- Create Post Content -->
    <main class="max-w-4xl mx-auto px-6 py-12">
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-100 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 p-4 bg-red-100 text-red-700 rounded-lg">
                {{ session('error') }}
            </div>
        @endif

        <div class="editor-card overflow-hidden">
            <!-- Editor Header -->
            <div class="px-8 py-6 border-b border-gray-100 flex items-center justify-between">
                <div>
                    <a href="{{ route('posts.user') }}" class="inline-flex items-center text-oceanic-deep/80 hover:text-oceanic-deep transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                        </svg>
                        Back to my posts
                    </a>
                </div>
                <div class="text-center">
                    <h1 class="text-xl font-semibold text-oceanic-slate">Create New Post</h1>
                </div>
                <div class="w-24"></div>
            </div>
            
            <!-- Create Form -->
            <div class="p-8">
                <form action="{{ route('posts.store') }}" method="POST" class="space-y-8">
                    @csrf
                    
                    <div class="space-y-2">
                        <label for="title" class="block text-sm font-medium text-oceanic-slate">Title</label>
                        <input type="text" id="title" name="title" value="{{ old('title') }}" required
                            class="input-field w-full px-5 py-3 rounded-lg bg-white focus:outline-none focus:ring-0">
                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="space-y-2">
                        <label for="body" class="block text-sm font-medium text-oceanic-slate">Content</label>
                        <textarea id="body" name="body" rows="10" required
                            class="input-field w-full px-5 py-3 rounded-lg bg-white focus:outline-none focus:ring-0">{{ old('body') }}</textarea>
                        @error('body')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label for="status" class="block text-sm font-medium text-oceanic-slate">Status</label>
                            <select id="status" name="status" class="input-field w-full px-5 py-3 rounded-lg bg-white focus:outline-none focus:ring-0">
                                <option value="draft" {{ old('status', 'draft') === 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Published</option>
                            </select>
                        </div>

                        <div class="space-y-2">
                            <label for="published_at" class="block text-sm font-medium text-oceanic-slate">Publish Date</label>
                            <input type="datetime-local" id="published_at" name="published_at" 
                                value="{{ old('published_at') }}"
                                class="input-field w-full px-5 py-3 rounded-lg bg-white focus:outline-none focus:ring-0">
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-end space-x-4 pt-4">
                        <a href="{{ route('posts.user') }}" class="px-6 py-2.5 rounded-lg text-oceanic-deep/80 hover:text-oceanic-deep font-medium transition-colors">
                            Cancel
                        </a>
                        <button type="submit" class="btn-primary px-7 py-2.5 rounded-lg text-white font-medium">
                            Create Post
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>