<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\SeenPost;
use App\Models\Genre;

class PostController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // 🔹すでに見た投稿のIDを取得
        $seenPostIds = SeenPost::where('user_id', $userId)->pluck('post_id')->toArray();

        // 🔹未読の投稿を1件ランダム取得（投稿がなければnullになる）
        $post = Post::whereNotIn('id', $seenPostIds)->inRandomOrder()->first();

        // 🔹ジャンル配列（とりあえず仮）
        $genres = Genre::pluck('name')->toArray();
        return view('posts.index', compact('post', 'genres'));
    }
}
