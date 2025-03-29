@extends('layouts.app')

@section('title', 'Oceanic | Modern Publishing Platform')

@section('content')
    @auth
        <!-- Dashboard Section -->
        <div class="row">
            <div class="col-lg-10 col-xl-8 mx-auto">
                <div class="d-flex justify-content-between align-items-end mb-4">
                    <div>
                        <h1 class="font-serif fs-2 fw-semibold">Your Dashboard</h1>
                        <p class="text-muted mt-2">Welcome back to your publishing workspace</p>
                    </div>
                </div>

                @if(session('success'))
                    <div class="alert alert-success mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Create Post Card -->
                <div class="card mb-5">
                    <div class="card-body">
                        <h2 class="font-serif fs-4 fw-semibold mb-4">Create new post</h2>
                        <form action="{{ route('posts.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" id="title" name="title" placeholder="What's your story about?" 
                                    class="form-control"
                                    value="{{ old('title') }}">
                                @error('title')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="body" class="form-label">Content</label>
                                <textarea id="body" name="body" placeholder="Write your thoughts here..." rows="6"
                                    class="form-control">{{ old('body') }}</textarea>
                                @error('body')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="status" class="form-label">Status</label>
                                <select id="status" name="status" class="form-select">
                                    <option value="draft" {{ old('status', 'draft') == 'draft' ? 'selected' : '' }}>Draft</option>
                                    <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                                </select>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">
                                    Save Post
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Posts Section -->
                <div>
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="font-serif fs-4 fw-semibold">Your Publications</h2>
                        <div class="text-muted">{{ $posts->total() ?? count($posts) }} {{ Str::plural('post', $posts->total() ?? count($posts)) }}</div>
                    </div>

                    @forelse($posts as $post)
                        <div class="post-item">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <h3 class="fs-5 fw-semibold">{{ $post->title }}</h3>
                                <div class="d-flex gap-2">
                                    @if(isset($post->status))
                                    <span class="badge {{ $post->status === 'published' ? 'badge-published' : 'badge-draft' }}">
                                        {{ ucfirst($post->status) }}
                                    </span>
                                    @endif
                                    <span class="badge badge-date">
                                        {{ $post->created_at->format('M d, Y') }}
                                    </span>
                                </div>
                            </div>
                            <p class="text-muted mb-3">{{ Str::limit($post->body, 150) }}</p>
                            <div class="d-flex justify-content-between align-items-center pt-3 border-top border-linen">
                                <div class="small text-muted">
                                    Last updated {{ $post->updated_at->diffForHumans() }}
                                </div>
                                <div class="d-flex gap-3">
                                    <a href="{{ route('posts.edit', $post) }}" class="text-sage text-decoration-none d-flex align-items-center small fw-medium">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="me-1">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        Edit
                                    </a>
                                    <form action="{{ route('posts.delete', $post) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link text-danger p-0 d-flex align-items-center small fw-medium">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="me-1">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="card text-center p-5">
                            <p class="text-muted mb-3">You haven't created any posts yet.</p>
                            <div>
                                <a href="{{ route('posts.create') }}" class="btn btn-primary">
                                    Create your first post
                                </a>
                            </div>
                        </div>
                    @endforelse

                    @if(isset($posts) && method_exists($posts, 'hasPages') && $posts->hasPages())
                        <div class="mt-4">
                            {{ $posts->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @else
        <!-- Guest Content -->
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center mb-5">
                <h1 class="font-serif display-5 fw-bold mb-3">Welcome to Oceanic</h1>
                <p class="text-muted fs-5 mb-5 mx-auto" style="max-width: 600px;">A refined space for your thoughts and stories</p>
            </div>
            
            <div class="row justify-content-center g-4 mb-5">
                <!-- Login Form -->
                <div class="col-md-5">
                    <div class="card shadow-sm h-100">
                        <div class="card-body p-4">
                            <h2 class="font-serif fs-3 fw-bold mb-4">Sign In</h2>
                            <form action="{{ route('login') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="loginname" class="form-label">Username</label>
                                    <input type="text" id="username" name="username" 
                                        class="form-control"
                                        placeholder="Enter your username"
                                        value="{{ old('username') }}"
                                        required>

                                    @error('loginname')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="loginpassword" class="form-label">Password</label>
                                    <input type="password" id="password" name="password" 
                                        class="form-control"
                                        placeholder="Enter your password"
                                        required>

                                    @error('loginpassword')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary w-100">
                                    Sign In
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Register Form -->
                <div class="col-md-5">
                    <div class="card shadow-sm h-100 bg-light">
                        <div class="card-body p-4">
                            <h2 class="font-serif fs-3 fw-bold mb-4">Create an Account</h2>
                            <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" id="name" name="name" 
                                        class="form-control"
                                        placeholder="Enter your full name"
                                        value="{{ old('name') }}"
                                        required>
                                    @error('name')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" id="email" name="email" 
                                        class="form-control"
                                        placeholder="Enter your email"
                                        value="{{ old('email') }}"
                                        required>
                                    @error('email')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="avatar" class="form-label">Profile Picture (JPEG only)</label>
                                    <input type="file" id="avatar" name="avatar" accept="image/jpeg"
                                        class="form-control">
                                    @error('avatar')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" id="password" name="password" 
                                        class="form-control"
                                        placeholder="Create a password (min 8 characters)"
                                        required>
                                    @error('password')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-4">
                                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                                    <input type="password" id="password_confirmation" name="password_confirmation" 
                                        class="form-control"
                                        placeholder="Confirm your password"
                                        required>
                                </div>
                                
                                <button type="submit" class="btn btn-secondary w-100">
                                    Sign Up
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Features Section -->
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="text-center mb-5">
                        <h2 class="font-serif fs-2 fw-semibold mb-3">Thoughtful features for writers</h2>
                        <p class="text-muted mx-auto" style="max-width: 600px;">Designed to help you focus on what matters - your content.</p>
                    </div>
                    <div class="row g-4">
                        <div class="col-md-4">
                            <div class="card h-100">
                                <div class="card-body p-4">
                                    <div class="feature-icon feature-icon-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </div>
                                    <h3 class="fw-medium mb-2">Minimal editor</h3>
                                    <p class="text-muted small">Clean writing interface without distractions</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card h-100">
                                <div class="card-body p-4">
                                    <div class="feature-icon feature-icon-blush">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z" />
                                        </svg>
                                    </div>
                                    <h3 class="fw-medium mb-2">Organized dashboard</h3>
                                    <p class="text-muted small">Manage all your publications in one place</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card h-100">
                                <div class="card-body p-4">
                                    <div class="feature-icon feature-icon-secondary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                        </svg>
                                    </div>
                                    <h3 class="fw-medium mb-2">Secure platform</h3>
                                    <p class="text-muted small">Your content is always protected</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endauth
@endsection

