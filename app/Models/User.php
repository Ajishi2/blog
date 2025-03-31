<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'username',  // Make sure this is included
        'email',
        'password',
        'avatar',
        'bio'       // If you're using this field
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Relationships
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function publishedPosts(): HasMany
    {
        return $this->hasMany(Post::class)
                    ->where('status', 'published')
                    ->latest('published_at');
    }

    // Accessors
    public function getAvatarUrlAttribute(): string
    {
        return $this->avatar 
            ? asset('storage/'.$this->avatar) 
            : asset('images/default-avatar.png');
    }

    // Mutators
    public function setNameAttribute($value): void
    {
        $this->attributes['name'] = $value;
        
        if (!isset($this->attributes['username'])) {
            $username = Str::slug($value);
            $originalUsername = $username;
            $count = 1;

            while (self::where('username', $username)->exists()) {
                $username = $originalUsername . $count;
                $count++;
            }

            $this->attributes['username'] = $username;
        }
    }

    // Methods
    public function isProfileComplete(): bool
    {
        return !empty($this->bio) && !empty($this->avatar);
    }
}