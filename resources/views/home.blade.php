@extends('layouts.app')

@section('title', 'Oceanic | Modern Publishing Platform')

@section('content')
    @auth
        <!-- Dashboard Section for logged-in users -->
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="d-flex justify-content-between align-items-end mb-4">
                        <div>
                            <h1 class="font-serif display-6 fw-bold mb-1">Your Dashboard</h1>
                            <p class="text-muted">Welcome back to your publishing workspace</p>
                        </div>
                        <a href="{{ route('posts.create') }}" class="btn btn-primary">
                            Create New Post
                        </a>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Recent Posts Section -->
                    <div class="card">
                        <div class="card-header bg-white">
                            <h2 class="font-serif fs-4 fw-semibold mb-0">Your Recent Publications</h2>
                        </div>
                        <div class="card-body">
                            @forelse($posts as $post)
                                <div class="post-item mb-4 pb-4 border-bottom">
                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                        <h3 class="fs-5 fw-semibold">{{ $post->title }}</h3>
                                        <div class="d-flex gap-2">
                                            <span class="badge {{ $post->status === 'published' ? 'bg-success' : 'bg-secondary' }}">
                                                {{ ucfirst($post->status) }}
                                            </span>
                                            <span class="badge bg-primary">
                                                {{ $post->created_at->format('M d, Y') }}
                                            </span>
                                        </div>
                                    </div>
                                    <p class="text-muted mb-3">{{ Str::limit(strip_tags($post->body), 150) }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-muted">
                                            Last updated {{ $post->updated_at->diffForHumans() }}
                                        </small>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('posts.edit', $post) }}" class="btn btn-sm btn-outline-primary">
                                                Edit
                                            </a>
                                            <form action="{{ route('posts.destroy', $post) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-5">
                                    <p class="text-muted mb-4">You haven't created any posts yet.</p>
                                    <a href="{{ route('posts.create') }}" class="btn btn-primary">
                                        Create your first post
                                    </a>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <!-- Guest Landing Page with Login/Registration -->
        <div class="container py-5">
            <div class="row justify-content-center text-center mb-5">
                <div class="col-lg-8">
                    <h1 class="font-serif display-5 fw-bold mb-3">Welcome to Oceanic</h1>
                    <p class="text-muted fs-5">A refined space for your thoughts and stories</p>
                </div>
            </div>
            
            <!-- Login and Registration Forms -->
            <div class="row justify-content-center g-4 mb-5">
                <!-- Login Form -->
                <div class="col-md-5">
                    <div class="card shadow-sm h-100">
                        <div class="card-body p-4">
                            <h2 class="font-serif fs-3 fw-bold mb-4">Sign In</h2>
                            <form action="{{ route('login') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" id="username" name="username" 
                                        class="form-control @error('username') is-invalid @enderror"
                                        placeholder="Enter your username"
                                        value="{{ old('username') }}"
                                        required>
                                    @error('username')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" id="password" name="password" 
                                        class="form-control @error('password') is-invalid @enderror"
                                        placeholder="Enter your password"
                                        required>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
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
                        class="form-control @error('name') is-invalid @enderror"
                        placeholder="Enter your name"
                        value="{{ old('name') }}"
                        required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" id="username" name="username" 
                        class="form-control @error('username') is-invalid @enderror"
                        placeholder="Choose a username"
                        value="{{ old('username') }}"
                        required>
                    @error('username')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" 
                        class="form-control @error('email') is-invalid @enderror"
                        placeholder="Enter your email"
                        value="{{ old('email') }}"
                        required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="avatar" class="form-label">Profile Picture (JPEG only)</label>
                    <input type="file" id="avatar" name="avatar" accept="image/jpeg"
                        class="form-control @error('avatar') is-invalid @enderror">
                    @error('avatar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" name="password" 
                        class="form-control @error('password') is-invalid @enderror"
                        placeholder="Create a password (min 8 characters)"
                        required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
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
            
            <!-- Features Section -->
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="text-center mb-5">
                        <h2 class="font-serif fs-2 fw-semibold mb-3">Thoughtful features for writers</h2>
                    </div>
                    <div class="row g-4">
                        <div class="col-md-4">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body text-center p-4">
                                    <div class="icon-lg bg-primary bg-opacity-10 text-primary rounded-circle mb-3 mx-auto">
                                        <i class="bi bi-pencil"></i>
                                    </div>
                                    <h3 class="fw-medium mb-2">Minimal Editor</h3>
                                    <p class="text-muted">Clean writing interface without distractions</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body text-center p-4">
                                    <div class="icon-lg bg-success bg-opacity-10 text-success rounded-circle mb-3 mx-auto">
                                        <i class="bi bi-layout-text-window"></i>
                                    </div>
                                    <h3 class="fw-medium mb-2">Organized Dashboard</h3>
                                    <p class="text-muted">Manage all your publications in one place</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body text-center p-4">
                                    <div class="icon-lg bg-info bg-opacity-10 text-info rounded-circle mb-3 mx-auto">
                                        <i class="bi bi-shield-lock"></i>
                                    </div>
                                    <h3 class="fw-medium mb-2">Secure Platform</h3>
                                    <p class="text-muted">Your content is always protected</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endauth
@endsection
