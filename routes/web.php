<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;

// Main route
Route::get('/', [HomeController::class, 'index'])->name('home');

// Authentication routes
Route::middleware('guest')->group(function () {
    // Show login form (GET)
    Route::get('/login', function () {
        return redirect('/')->with('show_login', true);
    })->name('login');
    
    // Handle login submission (POST)
    Route::post('/login', [UserController::class, 'login']);
    
    // Show registration form (GET)
    Route::get('/register', function () {
        return redirect('/')->with('show_register', true);
    })->name('register');
    
    // Handle registration submission (POST)
    Route::post('/register', [UserController::class, 'register']);
});

// Logout (POST)
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

// Post routes
Route::prefix('posts')->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('/user', [PostController::class, 'userPosts'])->name('posts.user');
        Route::get('/create', [PostController::class, 'create'])->name('posts.create');
        Route::post('/store', [PostController::class, 'store'])->name('posts.store');
        Route::get('/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
        Route::put('/{post}/update', [PostController::class, 'update'])->name('posts.update');
        Route::delete('/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
    });
    
    Route::get('/{post}', [PostController::class, 'show'])->name('posts.show');
});