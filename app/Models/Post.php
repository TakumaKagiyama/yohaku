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
        'user_id',
        'genre_id',
    ];
    // リレーション
    protected $fillable = ['user_id', 'genre_id', 'content', 'image'];

    // 🔹投稿をしたユーザーとのリレーション（1投稿は1ユーザーに属す）
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 🔹ジャンルとのリレーション（1投稿は1ジャンルに属す
    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    // 🔹保存済みとのリレーション（1投稿に対して複数の保存）
    public function savePosts()
    {
        return $this->hasMany(SavePost::class);
    }

    // 🔹閲覧済みとのリレーション（1投稿に対して複数の閲覧記録）
    public function seenPosts()
    {
        return $this->hasMany(SeenPost::class);
    }
}
