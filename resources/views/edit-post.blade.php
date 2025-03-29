@extends('layouts.app')

@section('title', isset($mode) ? ($mode === 'create' ? 'Create Post' : 'Edit Post') : 'View Post')

@push('styles')
<style>
    .tox-tinymce {
        border-radius: 0.5rem;
        border-color: var(--oceanic-gray-300) !important;
    }
    
    .cover-image-preview {
        max-height: 200px;
        width: auto;
        border-radius: 0.5rem;
        object-fit: cover;
    }
    
    .cover-image-container {
        position: relative;
        display: inline-block;
    }
    
    .remove-image {
        position: absolute;
        top: 5px;
        right: 5px;
        background: rgba(255, 255, 255, 0.8);
        border-radius: 50%;
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    
    .remove-image:hover {
        background: rgba(255, 255, 255, 1);
        transform: scale(1.1);
    }
</style>
@endpush

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-10">
            @if(session('success'))
                <div class="alert alert-success mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card @if(isset($readOnly) && $readOnly) read-only @endif rounded-4">
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
                    @else
                        <!-- Editable form -->
                        @if(isset($mode) && $mode === 'create')
                        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                        @else
                        <form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @endif
                        @csrf
                        
                        <div class="mb-4">
                            <label for="cover_image" class="form-label small fw-medium text-charcoal">Cover Image</label>
                            <input type="file" id="cover_image" name="cover_image" class="form-control" accept="image/*">
                            @error('cover_image')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                            
                            @if(isset($post) && $post->cover_image)
                                <div class="mt-3 cover-image-container">
                                    <img src="{{ asset('storage/' . $post->cover_image) }}" alt="Cover Image" class="cover-image-preview">
                                    <div class="remove-image" id="remove-cover-image">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </div>
                                    <input type="hidden" name="remove_cover_image" id="remove_cover_image" value="0">
                                </div>
                            @endif
                        </div>
                        
                        <div class="mb-4">
                            <label for="title" class="form-label small fw-medium text-charcoal">Title</label>
                            <input type="text" id="title" name="title" 
                                   value="{{ isset($post) ? old('title', $post->title) : old('title') }}" 
                                   required class="form-control">
                            @error('title')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="body" class="form-label small fw-medium text-charcoal">Content</label>
                            <textarea id="body" name="body" rows="10" required
                                class="form-control tinymce-editor">@if(isset($post)){{ old('body', $post->body) }}@else{{ old('body') }}@endif</textarea>
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
                        
                        <div class="d-flex justify-content-end gap-3 mt-4 pt-3 border-top" style="border-color: var(--oceanic-gray-200)!important">
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

@push('scripts')
<script src="{{ asset('js/tinymce/tinymce/js/tinymce/tinymce.min.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        tinymce.init({
            selector: '.tinymce-editor',
            height: 400,
            menubar: true,
            plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table paste code help wordcount'
            ],
            toolbar: 'undo redo | formatselect | ' +
                'bold italic backcolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | help',
            content_style: 'body { font-family: Inter, sans-serif; font-size: 16px; }',
            skin: 'oxide',
            skin_url: '{{ asset("js/tinymce/tinymce/js/tinymce/skins/ui/oxide") }}',
            content_css: [
                '{{ asset("css/app.css") }}',
                'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap'
            ],
            forced_root_block: '', // This prevents automatic <p> tags
            entity_encoding: 'raw', // This prevents entity encoding
            
            // Handle cover image removal
            setup: function(editor) {
                editor.on('change', function() {
                    editor.save();
                });
            }
        });
        
        // Handle cover image removal
        const removeImageBtn = document.getElementById('remove-cover-image');
        if (removeImageBtn) {
            removeImageBtn.addEventListener('click', function() {
                const container = this.closest('.cover-image-container');
                const removeInput = document.getElementById('remove_cover_image');
                
                container.style.display = 'none';
                removeInput.value = '1';
            });
        }
    });
</script>
@endpush

