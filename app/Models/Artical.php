<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artical extends Model
{
    use HasFactory;

    // In the Article model
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

// In your Article model
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
