<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    public $timestamps = false;
    protected $fillable = ['name', 'email', 'password', 'is_admin', 'created_at', 'profile_image'];


    public function posts()
    {
        return $this->hasMany(Post::class);
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
