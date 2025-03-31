@extends('layouts.app')

@section('title', 'My Posts | Oceanic')

@section('content')

    <div class="row">
        <div class="col-lg-10 mx-auto">
            <!-- Page Header -->
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-5">
                <div class="mb-3 mb-md-0">
                    <h1 class="font-serif display-6 fw-bold text-primary mb-1">My Publications</h1>
                    <p class="text-muted">Manage and organize your creative content</p>
                </div>
                <div>
                    <a href="{{ route('posts.create') }}" class="btn btn-primary d-flex align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="me-2">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Create New Post
                    </a>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success d-flex align-items-center mb-4" role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="me-2 flex-shrink-0">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div>{{ session('success') }}</div>
                </div>
            @endif

            <!-- Filter and Search -->
            <div class="card mb-4 border-0 shadow-sm">
                <div class="card-body p-4">
                    <form action="{{ route('posts.user') }}" method="GET" class="row g-3 align-items-end">
                        <div class="col-md-4">
                            <label for="status_filter" class="form-label small fw-medium text-charcoal">Filter by Status</label>
                            <select id="status_filter" name="status" class="form-select">
                                <option value="">All Posts</option>
                                <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published</option>
                                <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Drafts</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="search" class="form-label small fw-medium text-charcoal">Search Posts</label>
                            <input type="text" id="search" name="search" class="form-control" placeholder="Search by title or content..." value="{{ request('search') }}">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-secondary w-100">Apply</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Posts List -->
            <div class="posts-container">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="font-serif fs-4 fw-semibold">Your Content</h2>
                    <div class="text-muted">{{ $posts->total() ?? count($posts) }} {{ Str::plural('post', $posts->total() ?? count($posts)) }}</div>
                </div>

                @forelse($posts as $post)
                    <div class="card mb-4 post-card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <h3 class="fs-5 fw-semibold mb-0">
                                    <a href="{{ route('posts.show', $post) }}" class="text-decoration-none text-dark post-title-btn">
                                        {{ $post->title }}
                                    </a>
                                </h3>
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
                            
                            <p class="text-muted mb-3">{{ Str::limit(strip_tags($post->body), 150) }}</p>
                            
                            <div class="d-flex justify-content-between align-items-center pt-3 border-top border-light">
                                <div class="small text-muted d-flex align-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="me-1">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Last updated {{ $post->updated_at->diffForHumans() }}
                                </div>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('posts.edit', $post) }}" class="btn btn-sm btn-outline-primary d-flex align-items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="me-1">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        Edit
                                    </a>
                                    <form action="{{ route('posts.destroy', $post) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger d-flex align-items-center" onclick="return confirm('Are you sure you want to delete this post?')">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="me-1">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-5 bg-light rounded-4 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="text-secondary mx-auto mb-3">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                        <h3 class="font-serif fs-4 fw-semibold mb-3">No posts found</h3>
                        <p class="text-muted mb-4">You haven't created any posts yet.</p>
                        <a href="{{ route('posts.create') }}" class="btn btn-primary">
                            Create your first post
                        </a>
                    </div>
                @endforelse

                @if(isset($posts) && method_exists($posts, 'hasPages') && $posts->hasPages())
                    <div class="mt-4 d-flex justify-content-center">
                        <nav aria-label="Page navigation">
                            <ul class="pagination">
                                {{-- Previous Page Link --}}
                                @if ($posts->onFirstPage())
                                    <li class="page-item disabled">
                                        <span class="page-link">&laquo;</span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $posts->previousPageUrl() }}" rel="prev">&laquo;</a>
                                    </li>
                                @endif

                                {{-- Pagination Elements --}}
                                @foreach ($posts->getUrlRange(1, $posts->lastPage()) as $page => $url)
                                    @if ($page == $posts->currentPage())
                                        <li class="page-item active">
                                            <span class="page-link">{{ $page }}</span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                    @endif
                                @endforeach

                                {{-- Next Page Link --}}
                                @if ($posts->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $posts->nextPageUrl() }}" rel="next">&raquo;</a>
                                    </li>
                                @else
                                    <li class="page-item disabled">
                                        <span class="page-link">&raquo;</span>
                                    </li>
                                @endif
                            </ul>
                        </nav>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .post-card {
        transition: all 0.3s ease;
        border-radius: 0.75rem;
        overflow: hidden;
    }
    
    .post-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08) !important;
    }
    
    .post-title-btn {
        font-weight: 600;
        transition: all 0.2s ease;
        display: block;
        width: 100%;
    }
    
    .post-title-btn:hover, .post-title-btn:focus {
        color: var(--bs-primary) !important;
    }
    
    .badge-published {
        background-color: rgba(25, 135, 84, 0.15);
        color: #198754;
        font-weight: 500;
        padding: 0.35em 0.65em;
    }
    
    .badge-draft {
        background-color: rgba(108, 117, 125, 0.15);
        color: #6c757d;
        font-weight: 500;
        padding: 0.35em 0.65em;
    }
    
    .badge-date {
        background-color: rgba(13, 110, 253, 0.15);
        color: #0d6efd;
        font-weight: 500;
        padding: 0.35em 0.65em;
    }
    
    .page-link {
        color: var(--bs-primary);
        border-color: #dee2e6;
    }
    
    .page-item.active .page-link {
        background-color: var(--bs-primary);
        border-color: var(--bs-primary);
    }
    
    .page-link:hover {
        color: var(--bs-primary-dark);
    }
    
    .btn-outline-primary {
        border-color: var(--bs-primary);
        color: var(--bs-primary);
    }
    
    .btn-outline-primary:hover {
        background-color: var(--bs-primary);
        border-color: var(--bs-primary);
        color: white;
    }
    
    .btn-outline-danger {
        border-color: #dc3545;
        color: #dc3545;
    }
    
    .btn-outline-danger:hover {
        background-color: #dc3545;
        border-color: #dc3545;
        color: white;
    }
</style>
@endpush
