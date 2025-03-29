@extends('layouts.app')

@section('title', $pageTitle ?? 'My Posts')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <h1 class="h2 mb-4">{{ $pageTitle ?? 'My Posts' }}</h1>

            @if(session('success'))
                <div class="alert alert-success mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="row">
                @forelse($posts as $post)
                    <div class="col-12 mb-4">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <h3 class="h5 mb-0">{{ $post->title }}</h3>
                                    <div class="d-flex gap-2">
                                        <span class="badge {{ $post->status === 'published' ? 'bg-success' : 'bg-warning' }}">
                                            {{ ucfirst($post->status) }}
                                        </span>
                                        <span class="badge bg-secondary">
                                            {{ $post->created_at->format('M d, Y') }}
                                        </span>
                                    </div>
                                </div>
                                <p class="text-muted mb-3">{{ Str::limit($post->body, 150) }}</p>
                                <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                                    <small class="text-muted">
                                        Last updated {{ $post->updated_at->diffForHumans() }}
                                    </small>
                                    <div class="d-flex gap-3">
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
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="card text-center py-5">
                            <p class="text-muted mb-3">You haven't created any posts yet.</p>
                            <a href="{{ route('posts.create') }}" class="btn btn-primary">
                                Create your first post
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>

            @if($posts->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $posts->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection