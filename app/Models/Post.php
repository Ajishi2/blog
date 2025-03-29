<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'status',
        'published_at',
        'cover_image',  // Make sure this is included
        'user_id'
    ];

    protected $dates = ['published_at'];

    // Default values for new posts
    protected $attributes = [
        'status' => 'draft',
    ];
    protected $casts = [
        'published_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    // Generate a unique slug from the title
    public function generateSlug($title)
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $count = 1;

        // Ensure unique slug
        while (self::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        return $slug;
    }

    // Automatically generate slug when title is set
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = $this->generateSlug($value);
        
        // Automatically generate excerpt if not provided
        if (!isset($this->attributes['excerpt'])) {
            $this->attributes['excerpt'] = Str::limit(strip_tags($value), 150);
        }
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    // Scope for published posts
    public function scopePublished($query)
    {
        return $query->where('status', 'published')
                     ->whereNotNull('published_at')
                     ->where('published_at', '<=', now());
    }

    // Scope for user's posts
    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
}