@extends('layouts.app')

@section('title', isset($mode) ? ($mode === 'create' ? 'Create Post' : 'Edit Post') : 'View Post')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            @if(session('success'))
                <div class="alert alert-success mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card @if(isset($readOnly) && $readOnly) read-only @endif rounded-4">
                <div class="card-header d-flex align-items-center justify-content-between py-3 px-4 border-bottom" style="border-color: var(--linen)!important">
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
                            @if(isset($mode))
                                @if($mode === 'create')
                                    Create New Post
                                @else
                                    Editing Post
                                @endif
                            @else
                                Viewing Post
                            @endif
                        </h1>
                        @if(!isset($mode) || $mode !== 'create')
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
                        @endif
                    </div>
                    <div style="width: 6rem;">
                        @if(isset($readOnly) && $readOnly && auth()->id() === $post->user_id)
                            <a href="{{ route('posts.edit', $post) }}" 
                               class="btn btn-primary btn-sm">
                                Edit
                            </a>
                        @endif
                    </div>
                </div>
                
                <div class="card-body p-4">
                    @if(isset($readOnly) && $readOnly)
                        <!-- Read-only view -->
                        <article>
                            <h2 class="font-serif fs-1 fw-bold text-charcoal mb-4">{{ $post->title }}</h2>
                            <div class="text-muted" style="white-space: pre-line;">
                                {{ $post->body }}
                            </div>
                        </article>
                    @else
                        <!-- Editable form -->
                        @if(isset($mode) && $mode === 'create')
                        <form action="{{ route('posts.store') }}" method="POST">
                        @else
                        <form action="{{ route('posts.update', $post) }}" method="POST">
                        @method('PUT')
                        @endif
                        @csrf
                        
                        <div class="mb-3">
                            <label for="title" class="form-label small fw-medium text-charcoal">Title</label>
                            <input type="text" id="title" name="title" 
                                   value="{{ isset($post) ? old('title', $post->title) : old('title') }}" 
                                   required class="form-control">
                            @error('title')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="body" class="form-label small fw-medium text-charcoal">Content</label>
                            <textarea id="body" name="body" rows="10" required
                                class="form-control">@if(isset($post)){{ old('body', $post->body) }}@else{{ old('body') }}@endif</textarea>
                            @error('body')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <label for="status" class="form-label small fw-medium text-charcoal">Status</label>
                                <select id="status" name="status" class="form-select">
                                    <option value="draft" {{ (isset($post) && old('status', $post->status) === 'draft') || old('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                                    <option value="published" {{ (isset($post) && old('status', $post->status) === 'published') || old('status') === 'published' ? 'selected' : '' }}>Published</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="published_at" class="form-label small fw-medium text-charcoal">Publish Date</label>
                                <input type="datetime-local" id="published_at" name="published_at" 
                                    value="{{ isset($post) ? old('published_at', $post->published_at ? $post->published_at->format('Y-m-d\TH:i') : '') : old('published_at') }}"
                                    class="form-control">
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-end gap-3 mt-4 pt-3 border-top" style="border-color: var(--linen)!important">
                            <a href="{{ route('posts.user') }}" class="btn btn-link">
                                Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                @if(isset($mode) && $mode === 'create')
                                    Create Post
                                @else
                                    Update Post
                                @endif
                            </button>
                        </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

