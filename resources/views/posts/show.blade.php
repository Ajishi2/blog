@extends('layouts.app')

@section('title', $post->title . ' | Oceanic')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card rounded-4">
                <div class="card-header d-flex align-items-center justify-content-between py-3 px-4 border-bottom" style="border-color: var(--oceanic-gray-200)!important">
                    <div>
                        <a href="{{ route('posts.user') }}" class="d-inline-flex align-items-center text-muted text-decoration-none">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="me-2">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Back to my posts
                        </a>
                    </div>
                    <div class="text-center">
                        <h1 class="font-serif fs-4 fw-semibold text-charcoal mb-0">
                            Viewing Post
                        </h1>
                        <p class="small text-muted mt-1 mb-0">
                            @if(isset($post->published_at) && $post->published_at)
                                Published 
                                @if(is_string($post->published_at))
                                    {{ \Carbon\Carbon::parse($post->published_at)->format('M d, Y') }}
                                @else
                                    {{ $post->published_at->format('M d, Y') }}
                                @endif
                            @else
                                Created {{ $post->created_at->diffForHumans() }}
                            @endif
                        </p>
                    </div>
                    <div style="width: 6rem;">
                        @if(auth()->id() === $post->user_id)
                            <a href="{{ route('posts.edit', $post) }}" 
                               class="btn btn-primary btn-sm">
                                Edit
                            </a>
                        @endif
                    </div>
                </div>
                
                <div class="card-body p-4">
                    <article>
                        @if(isset($post->cover_image) && $post->cover_image)
                            <div class="mb-4">
                                <img src="{{ asset('storage/' . $post->cover_image) }}" alt="{{ $post->title }}" class="img-fluid rounded-4 w-100" style="max-height: 400px; object-fit: cover;">
                            </div>
                        @endif
                        <h2 class="font-serif fs-1 fw-bold text-charcoal mb-4">{{ $post->title }}</h2>
                        <div class="content">
                            {!! $post->body !!}
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .content img {
        max-width: 100%;
        height: auto;
        border-radius: 0.5rem;
        margin: 1rem 0;
    }
</style>
@endpush

