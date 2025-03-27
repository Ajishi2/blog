<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $posts = auth()->check() 
            ? Post::published()->latest()->paginate(10)
            : collect(); // Empty collection for guests

        return view('home', ['posts' => $posts]);
    }
}