<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function show(Post $post)
    {
        return view('edit-post', [
            'post' => $post,
            'readOnly' => true,
            'pageTitle' => $post->title
        ]);
    }

public function edit(Post $post)
{
    return view('edit-post', [ // Without 'posts.' prefix
        'post' => $post,
        'mode' => 'edit',
        'pageTitle' => "Editing: {$post->title}"
    ]);
}
public function create()
{
    return view('posts.create', [
        'post' => new Post(),
        'mode' => 'create',
        'pageTitle' => 'Create New Post'
    ]);
}


public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|max:255',
        'body' => 'required',
        'status' => 'in:draft,published',
        'published_at' => 'nullable|date'
    ]);

    $post = Post::create([
        'title' => strip_tags($validated['title']),
        'body' => strip_tags($validated['body']),
        'status' => $validated['status'] ?? 'draft',
        'published_at' => $validated['status'] === 'published' 
            ? ($validated['published_at'] ?? now())
            : null,
        'user_id' => Auth::id()
    ]);

    return redirect()->route('posts.user')
                   ->with('success', 'Post created successfully');
}
    public function update(Request $request, Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            return redirect()->route('posts.show', $post)
                           ->with('error', 'Unauthorized to update this post');
        }

        $validated = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'status' => 'in:draft,published',
            'published_at' => 'nullable|date'
        ]);

        $post->update([
            'title' => strip_tags($validated['title']),
            'body' => strip_tags($validated['body']),
            'status' => $validated['status'],
            'published_at' => $validated['status'] === 'published'
                ? ($validated['published_at'] ?? now())
                : null
        ]);

        return redirect()->route('posts.show', $post)
                       ->with('success', 'Post updated successfully');
    }

    public function destroy(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            return redirect()->route('posts.show', $post)
                           ->with('error', 'Unauthorized to delete this post');
        }

        $post->delete();
        return redirect()->route('posts.user')
                       ->with('success', 'Post deleted successfully');
    }

    public function userPosts()
    {
        $posts = auth()->user()->posts()->latest()->paginate(10);
        return view('posts.user', [
            'posts' => $posts,
            'pageTitle' => 'My Posts'
        ]);
    }
}