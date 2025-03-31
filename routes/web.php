<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Authentication routes
Route::get('/login', function () {
    return view('auth.login');
})->name('login')->middleware('guest');

Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout'])->name('logout');
Route::get('/register', function () {
    return view('auth.register');
})->name('register')->middleware('guest');
Route::post('/register', [UserController::class, 'register']);

// Post routes
Route::prefix('posts')->group(function () {
    // Routes that require authentication
    Route::middleware('auth')->group(function () {
        Route::get('/user', [PostController::class, 'userPosts'])->name('posts.user');
        Route::get('/create', [PostController::class, 'create'])->name('posts.create');
        Route::post('/store', [PostController::class, 'store'])->name('posts.store');
        
        Route::get('/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
        Route::put('/{post}/update', [PostController::class, 'update'])->name('posts.update');
        Route::delete('/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
    });
    
    // Public route for viewing posts - no auth required
    Route::get('/{post}', [PostController::class, 'show'])->name('posts.show');
});

