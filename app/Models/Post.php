<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['user_id', 'genre_id', 'content', 'image'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function savePosts()
    {
        return $this->hasMany(SavePost::class);
    }

    public function seenPosts()
    {
        return $this->hasMany(SeenPost::class);
    }
}

