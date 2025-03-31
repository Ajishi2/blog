@extends('layouts.app')

@section('title', 'Create New Post')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white border-bottom">
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ route('posts.user') }}" class="btn btn-sm btn-outline-secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="me-1">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Back
                        </a>
                        <h5 class="mb-0">Create New Post</h5>
                        <div style="width: 80px;"></div>
                    </div>
                </div>

                <div class="card-body">
                    <!-- Loading Indicator -->
                    <div id="loading-indicator" class="text-center py-4" style="display: none;">
                        <div class="mb-3">
                            <img src="https://media3.giphy.com/media/v1.Y2lkPTc5MGI3NjExb2dlcXViMTJnaGYzaHM1NW05NjA3dms2bGJ0Mzl4b3E3b3Y4Z2l3byZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9cw/YMM6g7x45coCKdrDoj/giphy.gif" alt="Loading" style="width: 250px; height: 250px; object-fit: contain;">
                        </div>
                        <h4 class="font-serif">Creating your post...</h4>
                    </div>

                    <!-- Success Message -->
                    <div id="success-message" class="alert alert-success text-center" style="display: none;">
                        <div class="d-flex align-items-center justify-content-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="me-2">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>Post created successfully! Redirecting...</span>
                        </div>
                    </div>

                    <!-- Form (initially visible) -->
                    <form id="post-form" action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" style="display: block;">
                        @csrf

                        <!-- Title Field -->
                        <div class="mb-4">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" 
                                   value="{{ old('title') }}" required>
                            @error('title')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Cover Image Field -->
                        <div class="mb-4">
                            <label for="cover_image" class="form-label">Cover Image</label>
                            <input type="file" class="form-control" id="cover_image" name="cover_image"
                                   accept="image/*">
                            @error('cover_image')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                            <div id="image-preview" class="mt-2"></div>
                        </div>

                        <!-- Status Field -->
                        <div class="mb-4">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                            </select>
                            @error('status')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Publish Date Field -->
                        <div class="mb-4" id="publish-date-container" style="display: none;">
                            <label for="published_at" class="form-label">Publish Date</label>
                            <input type="datetime-local" class="form-control" id="published_at" name="published_at"
                                   value="{{ old('published_at') }}">
                            @error('published_at')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Content Field -->
                        <div class="mb-4">
                            <label for="body" class="form-label">Content</label>
                            <textarea class="form-control" id="body" name="body" rows="10">{{ old('body', '') }}</textarea>
                            @error('body')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Form Actions -->
                        <div class="d-flex justify-content-end gap-3 border-top pt-4">
                            <a href="{{ route('posts.user') }}" class="btn btn-outline-secondary">
                                Cancel
                            </a>
                            <button type="submit" class="btn btn-primary" id="submit-btn">
                                Create Post
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    #loading-indicator {
        animation: fadeIn 1s ease-in-out;
    }
    
    #success-message {
        animation: fadeIn 0.5s ease-in-out;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endpush

@push('scripts')
<!-- Image Preview Script -->
<script>
document.getElementById('cover_image').addEventListener('change', function(e) {
    const preview = document.getElementById('image-preview');
    preview.innerHTML = '';
    
    if (this.files && this.files[0]) {
        const img = document.createElement('img');
        img.src = URL.createObjectURL(this.files[0]);
        img.classList.add('img-thumbnail');
        img.style.maxHeight = '200px';
        preview.appendChild(img);
    }
});
</script>

<!-- Status Change Handler -->
<script>
document.getElementById('status').addEventListener('change', function() {
    const publishDateContainer = document.getElementById('publish-date-container');
    if (this.value === 'published') {
        publishDateContainer.style.display = 'block';
        // Set default publish date to now if empty
        if (!document.getElementById('published_at').value) {
            const now = new Date();
            const localDateTime = new Date(now.getTime() - now.getTimezoneOffset() * 60000)
                .toISOString()
                .slice(0, 16);
            document.getElementById('published_at').value = localDateTime;
        }
    } else {
        publishDateContainer.style.display = 'none';
    }
});

// Initialize status field on page load
document.addEventListener('DOMContentLoaded', function() {
    if (document.getElementById('status').value === 'published') {
        document.getElementById('publish-date-container').style.display = 'block';
    }
});
</script>

<!-- TinyMCE Implementation -->
<script src="{{ asset('js/tinymce/tinymce/js/tinymce/tinymce.min.js') }}"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize TinyMCE with local files
    tinymce.init({
        selector: '#body',
        base_url: '{{ asset('js/tinymce/tinymce/js/tinymce') }}',
        plugins: 'lists link image',
        toolbar: 'bold italic | bullist numlist | link image',
        height: 500,
        menubar: false,
        branding: true,
        skin_url: '{{ asset('js/tinymce/tinymce/js/tinymce/skins/ui/oxide') }}',
        content_css: '{{ asset('js/tinymce/tinymce/js/tinymce/skins/content/default/content.css') }}',
        setup: function(editor) {
            editor.on('init', function() {
                console.log('Local TinyMCE initialized');
                editor.focus();
            });
            editor.on('change', function() {
                editor.save();
            });
        }
    });

    // Form submission handler
    document.getElementById('post-form').addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Show loading indicator
        document.getElementById('post-form').style.display = 'none';
        document.getElementById('loading-indicator').style.display = 'block';
        
        // Save TinyMCE content
        if (typeof tinymce !== 'undefined') {
            tinymce.triggerSave();
        }
        
        // Change button state
        const submitBtn = document.getElementById('submit-btn');
        submitBtn.disabled = true;
        submitBtn.innerHTML = `
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            Creating...
        `;
        
        // Show loading for 1 second, then show success message
        setTimeout(() => {
            document.getElementById('loading-indicator').style.display = 'none';
            document.getElementById('success-message').style.display = 'block';
            
            // Submit the form after another short delay
            setTimeout(() => {
                document.getElementById('post-form').submit();
            }, 2000);
        }, 2000);
    });
});
</script>
@endpush
@endsection