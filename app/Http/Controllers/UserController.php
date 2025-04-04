<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/posts/user')
                           ->with('success', 'Logged in successfully');
        }

        return redirect()->route('home')
                       ->withErrors(['username' => 'Invalid credentials'])
                       ->withInput($request->only('username'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'Logged out successfully');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'min:3', 'max:20'],
            'username' => ['required', 'min:3', 'max:20', Rule::unique('users', 'username')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:8', 'confirmed'],
            'avatar' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2048']
        ]);
    
        $avatarPath = $request->file('avatar')->store('avatars', 'public');
    
        $user = User::create([
            'name' => $validated['name'],
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'avatar' => $avatarPath
        ]);
    
        Auth::login($user);
        return redirect()->route('posts.user')
                       ->with('success', 'Account created successfully!');
    }
}