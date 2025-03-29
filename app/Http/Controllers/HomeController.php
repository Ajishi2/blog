<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
{
    // For authenticated users - show their posts
    if (auth()->check()) {
        $posts = auth()->user()->posts()->latest()->paginate(10);
        return view('home', compact('posts'));
    }

    // For guests - show empty collection or public posts
    return view('home', ['posts' => collect()]);
}
}