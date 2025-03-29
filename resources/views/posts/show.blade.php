@use('Mews\Purifier\Facades\Purifier')

@extends('layouts.app')

@section('title', $post->title)

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Cover Image Display -->
            @if($post->cover_image)
                <div class="card mb-4 border-0 shadow-sm">
                    <img src="{{ asset('storage/'.$post->cover_image) }}" 
                         class="card-img-top img-fluid"
                         alt="Post cover image"
                         style="max-height: 500px; object-fit: cover;">
                </div>
            @endif

            <!-- Post Content -->
            <div class="card mb-4 border-0 shadow-sm">
                <div class="card-body p-4">
                    <h1 class="font-serif fw-bold mb-4">{{ $post->title }}</h1>
                    
                    <div class="post-content mb-4">
                        {!! Purifier::clean($post->body) !!}
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                        <div class="text-muted small">
                            <span class="d-inline-flex align-items-center me-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="me-1">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                {{ $post->created_at->format('F j, Y') }}
                            </span>
                            <span class="badge {{ $post->status === 'published' ? 'bg-success' : 'bg-warning' }}">
                                {{ ucfirst($post->status) }}
                            </span>
                        </div>
                        
                        @auth
                            @if(auth()->id() === $post->user_id)
                                <div class="d-flex gap-2">
                                    <a href="{{ route('posts.edit', $post) }}" class="btn btn-sm btn-outline-primary">
                                        Edit Post
                                    </a>
                                </div>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .post-content {
        line-height: 1.8;
    }
    .post-content ul,
    .post-content ol {
        padding-left: 2rem;
        margin-bottom: 1.5rem;
    }
    .post-content li {
        margin-bottom: 0.5rem;
    }
    .post-content p {
        margin-bottom: 1.5rem;
    }
    .post-content img {
        max-width: 100%;
        height: auto;
        border-radius: 0.5rem;
        margin: 1.5rem 0;
    }
</style>
@endpush
