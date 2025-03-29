<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostImageController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:2048' // 2MB max
        ]);

        $path = $request->file('image')->store('post-covers', 'public');
        
        return response()->json([
            'path' => $path,
            'url' => Storage::url($path)
        ]);
    }
}