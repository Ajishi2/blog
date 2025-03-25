<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oceanic | Modern Publishing Platform</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
        .post-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background: white;
            box-shadow: 0 1px 3px rgba(93, 118, 139, 0.05);
        }
        .post-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 25px -5px rgba(93, 118, 139, 0.1);
        }
        .auth-panel {
            background: white;
            box-shadow: 0 25px 50px -12px rgba(93, 118, 139, 0.08);
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
        .input-field {
            transition: all 0.3s ease;
            border: 1px solid rgba(93, 118, 139, 0.2);
        }
        .input-field:focus {
            border-color: #5D768B;
            box-shadow: 0 0 0 3px rgba(93, 118, 139, 0.1);
        }
        .divider {
            position: relative;
        }
        .divider::after {
            content: '';
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            width: 1px;
            background: linear-gradient(to bottom, transparent, rgba(93, 118, 139, 0.1), transparent);
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
                    <a href="#" class="text-oceanic-deep/90 hover:text-oceanic-deep nav-pill font-medium">Explore</a>
                    <a href="#" class="text-oceanic-deep/90 hover:text-oceanic-deep nav-pill font-medium">Features</a>
                    <a href="#" class="text-oceanic-deep/90 hover:text-oceanic-deep nav-pill font-medium">Resources</a>
                </nav>
                <div class="flex items-center space-x-4">
                    <a href="/login" class="text-oceanic-deep/90 hover:text-oceanic-deep font-medium">Sign in</a>
                    <a href="/register" class="btn-primary px-5 py-2 rounded-lg text-white font-medium">Get started</a>
                </div>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-6 py-12">
        @auth
            <!-- Dashboard Section -->
            <section class="mb-16">
                <div class="flex justify-between items-end mb-8">
                    <div>
                        <h1 class="text-3xl font-semibold text-oceanic-slate">Your Dashboard</h1>
                        <p class="text-oceanic-deep/80 mt-2">Welcome back to your publishing workspace</p>
                    </div>
                    <form action="/logout" method="POST">
                        @csrf
                        <button class="px-5 py-2.5 rounded-lg border border-oceanic-deep/20 text-oceanic-deep/80 hover:bg-oceanic-deep/5 font-medium transition-colors">
                            Sign out
                        </button>
                    </form>
                </div>

                <!-- Create Post Card -->
                <div class="bg-white rounded-xl shadow-sm p-8 mb-10 border border-gray-100">
                    <h2 class="text-xl font-semibold text-oceanic-slate mb-6">Create new post</h2>
                    <form action="/create-post" method="POST" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 gap-6">
                            <div>
                                <label for="title" class="block text-sm font-medium text-oceanic-slate mb-2">Title</label>
                                <input type="text" id="title" name="title" placeholder="What's your story about?" 
                                    class="input-field w-full px-5 py-3 rounded-lg bg-white focus:outline-none focus:ring-0">
                            </div>
                            <div>
                                <label for="body" class="block text-sm font-medium text-oceanic-slate mb-2">Content</label>
                                <textarea id="body" name="body" placeholder="Write your thoughts here..." rows="6"
                                    class="input-field w-full px-5 py-3 rounded-lg bg-white focus:outline-none focus:ring-0"></textarea>
                            </div>
                        </div>
                        <div class="flex justify-end">
                            <button class="btn-primary px-7 py-3 rounded-lg text-white font-medium">
                                Publish post
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Posts Section -->
                <div>
                    <div class="flex justify-between items-center mb-8">
                        <h2 class="text-2xl font-semibold text-oceanic-slate">Your Publications</h2>
                        <div class="text-oceanic-deep/80">{{ count($posts) }} posts published</div>
                    </div>

                    <div class="grid grid-cols-1 gap-6">
                        @foreach($posts as $post)
                            <div class="post-card rounded-xl p-6 border border-gray-100">
                                <div class="flex justify-between items-start mb-4">
                                    <h3 class="text-lg font-semibold text-oceanic-slate">{{ $post['title'] }}</h3>
                                    <span class="text-xs font-medium text-oceanic-deep/70 bg-oceanic-shell px-3 py-1 rounded-full">
                                        {{ $post->created_at->format('M d, Y') }}
                                    </span>
                                </div>
                                <p class="text-oceanic-deep/90 mb-5 line-clamp-2">{{ $post['body'] }}</p>
                                <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                    <div class="flex items-center space-x-2 text-sm text-oceanic-deep/70">
                                        <span>By {{ $post->user->name }}</span>
                                        <span>•</span>
                                        <span>{{ $post->created_at->diffForHumans() }}</span>
                                    </div>
                                    <div class="flex space-x-3">
                                        <a href="/edit-post/{{ $post->id }}" class="text-oceanic-deep/80 hover:text-oceanic-deep flex items-center text-sm font-medium">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                            Edit
                                        </a>
                                        <form action="/delete-post/{{ $post->id }}" method="POST">
                                            @csrf
                                            @method("DELETE")
                                            <button class="text-red-500/80 hover:text-red-500 flex items-center text-sm font-medium">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @else
            <!-- Hero Section -->
            <section class="py-16">
                <div class="text-center max-w-3xl mx-auto mb-16">
                    <h1 class="text-4xl font-bold text-oceanic-slate tracking-tight mb-4">Publish with elegance</h1>
                    <p class="text-xl text-oceanic-deep/80 leading-relaxed">
                        Oceanic is a minimalist publishing platform for creators who value clean design and thoughtful expression.
                    </p>
                </div>

                <!-- Auth Panels -->
                <div class="max-w-5xl mx-auto">
                    <div class="auth-panel rounded-xl overflow-hidden">
                        <div class="md:flex">
                            <!-- Login Panel -->
                            <div class="w-full md:w-1/2 p-10">
                                <div class="max-w-sm mx-auto">
                                    <h2 class="text-2xl font-semibold text-oceanic-slate mb-8">Sign in to your account</h2>
                                    <form action="/login" method="post" class="space-y-6">
                                        @csrf
                                        <div>
                                            <label for="loginname" class="block text-sm font-medium text-oceanic-slate mb-2">Username</label>
                                            <input id="loginname" name="loginname" type="text" placeholder="Enter your username" 
                                                class="input-field w-full px-5 py-3 rounded-lg bg-white focus:outline-none focus:ring-0">
                                        </div>
                                        <div>
                                            <label for="loginpassword" class="block text-sm font-medium text-oceanic-slate mb-2">Password</label>
                                            <input id="loginpassword" name="loginpassword" type="password" placeholder="Enter your password" 
                                                class="input-field w-full px-5 py-3 rounded-lg bg-white focus:outline-none focus:ring-0">
                                        </div>
                                        <div class="pt-2">
                                            <button class="btn-primary w-full px-6 py-3.5 rounded-lg text-white font-medium">
                                                Sign in
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            
                            <!-- Register Panel -->
                            <div class="w-full md:w-1/2 p-10 bg-oceanic-breeze divider">
                                <div class="max-w-sm mx-auto">
                                    <h2 class="text-2xl font-semibold text-oceanic-slate mb-8">Create new account</h2>
                                    <form action="/register" method="post" class="space-y-6">
                                        @csrf
                                        <div>
                                            <label for="name" class="block text-sm font-medium text-oceanic-slate mb-2">Full name</label>
                                            <input id="name" name="name" type="text" placeholder="Enter your full name" 
                                                class="input-field w-full px-5 py-3 rounded-lg bg-white focus:outline-none focus:ring-0">
                                        </div>
                                        <div>
                                            <label for="email" class="block text-sm font-medium text-oceanic-slate mb-2">Email address</label>
                                            <input id="email" name="email" type="email" placeholder="Enter your email" 
                                                class="input-field w-full px-5 py-3 rounded-lg bg-white focus:outline-none focus:ring-0">
                                        </div>
                                        <div>
                                            <label for="password" class="block text-sm font-medium text-oceanic-slate mb-2">Password</label>
                                            <input id="password" name="password" type="password" placeholder="Create a password" 
                                                class="input-field w-full px-5 py-3 rounded-lg bg-white focus:outline-none focus:ring-0">
                                        </div>
                                        <div class="pt-2">
                                            <button class="btn-primary w-full px-6 py-3.5 rounded-lg text-white font-medium">
                                                Register
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Features Section -->
            <section class="py-16">
                <div class="text-center mb-16">
                    <h2 class="text-2xl font-semibold text-oceanic-slate mb-3">Thoughtful features for writers</h2>
                    <p class="text-oceanic-deep/80 max-w-2xl mx-auto">Designed to help you focus on what matters - your content.</p>
                </div>
                <div class="grid md:grid-cols-3 gap-8">
                    <div class="bg-white p-6 rounded-xl border border-gray-100">
                        <div class="w-10 h-10 rounded-lg bg-oceanic-deep/5 flex items-center justify-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-oceanic-deep" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </div>
                        <h3 class="font-medium text-oceanic-slate mb-2">Minimal editor</h3>
                        <p class="text-sm text-oceanic-deep/80">Clean writing interface without distractions</p>
                    </div>
                    <div class="bg-white p-6 rounded-xl border border-gray-100">
                        <div class="w-10 h-10 rounded-lg bg-oceanic-deep/5 flex items-center justify-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-oceanic-deep" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z" />
                            </svg>
                        </div>
                        <h3 class="font-medium text-oceanic-slate mb-2">Organized dashboard</h3>
                        <p class="text-sm text-oceanic-deep/80">Manage all your publications in one place</p>
                    </div>
                    <div class="bg-white p-6 rounded-xl border border-gray-100">
                        <div class="w-10 h-10 rounded-lg bg-oceanic-deep/5 flex items-center justify-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-oceanic-deep" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <h3 class="font-medium text-oceanic-slate mb-2">Secure platform</h3>
                        <p class="text-sm text-oceanic-deep/80">Your content is always protected</p>
                    </div>
                </div>
            </section>
        @endauth
    </main>
    
    <!-- Minimal Footer -->
    <footer class="bg-white border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-6">
            <div class="py-12 grid md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-lg font-semibold text-oceanic-slate mb-4">Oceanic</h3>
                    <p class="text-sm text-oceanic-deep/80">A minimalist publishing platform for thoughtful creators.</p>
                </div>
                <div>
                    <h4 class="text-sm font-semibold text-oceanic-slate mb-4 uppercase tracking-wider">Product</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-sm text-oceanic-deep/80 hover:text-oceanic-deep transition-colors">Features</a></li>
                        <li><a href="#" class="text-sm text-oceanic-deep/80 hover:text-oceanic-deep transition-colors">Pricing</a></li>
                        <li><a href="#" class="text-sm text-oceanic-deep/80 hover:text-oceanic-deep transition-colors">API</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-sm font-semibold text-oceanic-slate mb-4 uppercase tracking-wider">Resources</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-sm text-oceanic-deep/80 hover:text-oceanic-deep transition-colors">Documentation</a></li>
                        <li><a href="#" class="text-sm text-oceanic-deep/80 hover:text-oceanic-deep transition-colors">Guides</a></li>
                        <li><a href="#" class="text-sm text-oceanic-deep/80 hover:text-oceanic-deep transition-colors">Blog</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-sm font-semibold text-oceanic-slate mb-4 uppercase tracking-wider">Company</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-sm text-oceanic-deep/80 hover:text-oceanic-deep transition-colors">About</a></li>
                        <li><a href="#" class="text-sm text-oceanic-deep/80 hover:text-oceanic-deep transition-colors">Careers</a></li>
                        <li><a href="#" class="text-sm text-oceanic-deep/80 hover:text-oceanic-deep transition-colors">Contact</a></li>
                    </ul>
                </div>
            </div>
            <div class="py-6 border-t border-gray-100 text-center text-sm text-oceanic-deep/80">
                &copy; 2024 Oceanic. All rights reserved.
            </div>
        </div>
    </footer>
</body>
</html>