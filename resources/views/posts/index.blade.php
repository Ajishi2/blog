@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">All Posts</h1>

    @if($posts->count() > 0)
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($posts as $post)
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h2 class="text-xl font-semibold mb-2">{{ $post->title }}</h2>
                    <p class="text-gray-600 mb-4">{{ $post->excerpt }}</p>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-500">By {{ $post->user->name }}</span>
                        <span class="text-sm text-gray-500">{{ $post->published_at->diffForHumans() }}</span>
                    </div>
                    <a href="{{ route('posts.show', $post) }}" class="mt-4 inline-block text-blue-500 hover:underline">Read More</a>
                </div>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $posts->links() }}
        </div>
    @else
        <p class="text-gray-600">No posts found.</p>
    @endif
</div>
@endsection