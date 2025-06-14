<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeenPost extends Model
{
    protected $fillable = ['user_id', 'post_id', 'seen_at'];

    public $timestamps = false; // seen_at だけを使うので

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
