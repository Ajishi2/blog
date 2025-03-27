@extends('layouts.app')

@section('title', $pageTitle ?? 'My Posts')

@section('content')
    <div class="max-w-7xl mx-auto px-6 py-12">
        <h1 class="text-3xl font-semibold text-oceanic-slate mb-8">{{ $pageTitle ?? 'My Posts' }}</h1>

        @if(session('success'))
            <div class="mb-6 p-4 bg-green-100 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 gap-6">
            @forelse($posts as $post)
                <div class="post-card rounded-xl p-6 border border-gray-100">
                    <div class="flex justify-between items-start mb-4">
                        <h3 class="text-lg font-semibold text-oceanic-slate">{{ $post->title }}</h3>
                        <div class="flex items-center space-x-2">
                            <span class="text-xs font-medium {{ $post->status === 'published' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }} px-3 py-1 rounded-full">
                                {{ ucfirst($post->status) }}
                            </span>
                            <span class="text-xs font-medium text-oceanic-deep/70 bg-oceanic-shell px-3 py-1 rounded-full">
                                {{ $post->created_at->format('M d, Y') }}
                            </span>
                        </div>
                    </div>
                    <p class="text-oceanic-deep/90 mb-5 line-clamp-2">{{ $post->body }}</p>
                    <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                        <div class="flex items-center space-x-2 text-sm text-oceanic-deep/70">
                            <span>Last updated {{ $post->updated_at->diffForHumans() }}</span>
                        </div>
                        <div class="flex space-x-3">
                            <a href="{{ route('posts.edit', $post) }}" class="text-oceanic-deep/80 hover:text-oceanic-deep flex items-center text-sm font-medium">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Edit
                            </a>
                            <form action="{{ route('posts.destroy', $post) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500/80 hover:text-red-500 flex items-center text-sm font-medium">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-xl p-8 text-center border border-gray-100">
                    <p class="text-oceanic-deep/80">You haven't created any posts yet.</p>
                    <a href="{{ route('posts.create') }}" class="btn-primary inline-block mt-4 px-5 py-2 rounded-lg text-white font-medium">
                        Create your first post
                    </a>
                </div>
            @endforelse
        </div>

        @if($posts->hasPages())
            <div class="mt-8">
                {{ $posts->links() }}
            </div>
        @endif
    </div>
@endsection