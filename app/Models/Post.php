<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'image',
        'content',
<<<<<<< Updated upstream
        'user_id',
=======
>>>>>>> Stashed changes
        'genre_id',
    ];
    // リレーション
    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }
}
