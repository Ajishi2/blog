<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
            'status' => 'required|in:draft,published',
            'published_at' => 'nullable|date',
            'cover_image' => 'nullable|image|max:2048'
        ]);

        try {
            // Handle file upload
            if ($request->hasFile('cover_image')) {
                $validated['cover_image'] = $request->file('cover_image')->store('post-covers', 'public');
            }

            $post = Post::create([
                'title' => $validated['title'],
                'body' => $validated['body'],
                'status' => $validated['status'],
                'published_at' => $validated['status'] === 'published' 
                    ? ($validated['published_at'] ?? now())
                    : null,
                'user_id' => auth()->id(),
                'cover_image' => $validated['cover_image'] ?? null
            ]);

            return redirect()->route('posts.show', $post)
                 ->with('success', 'Post created successfully!');

        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Error creating post: ' . $e->getMessage());
        }
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
            'published_at' => 'nullable|date',
            'cover_image' => 'nullable|image|max:2048',
            'remove_cover_image' => 'nullable|boolean'
        ]);

        try {
            // Handle cover image
            if ($request->hasFile('cover_image')) {
                // Delete old image if exists
                if ($post->cover_image) {
                    Storage::disk('public')->delete($post->cover_image);
                }
                
                // Store new image
                $validated['cover_image'] = $request->file('cover_image')->store('post-covers', 'public');
            } elseif ($request->input('remove_cover_image') == 1 && $post->cover_image) {
                // Remove cover image if requested
                Storage::disk('public')->delete($post->cover_image);
                $post->cover_image = null;
            }

            $post->update([
                'title' => $validated['title'],
                'body' => $validated['body'],
                'status' => $validated['status'],
                'published_at' => $validated['status'] === 'published'
                    ? ($validated['published_at'] ?? now())
                    : null,
                'cover_image' => $request->hasFile('cover_image') ? $validated['cover_image'] : ($request->input('remove_cover_image') == 1 ? null : $post->cover_image)
            ]);

            return redirect()->route('posts.show', $post)
                           ->with('success', 'Post updated successfully');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Error updating post: ' . $e->getMessage());
        }
    }

    public function destroy(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            return redirect()->route('posts.show', $post)
                           ->with('error', 'Unauthorized to delete this post');
        }

        // Delete cover image if exists
        if ($post->cover_image) {
            Storage::disk('public')->delete($post->cover_image);
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

