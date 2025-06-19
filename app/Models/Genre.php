<?php

<<<<<<< Updated upstream
=======
//川上がgenres.phpをGenre.phpに改名しましたごめんなさい
>>>>>>> Stashed changes

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $fillable = ['name'];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}

