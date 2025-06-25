<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Post;

class MyPageController extends Controller
{
    public function journal()
    {
        $user = Auth::user(); // ログイン中のユーザー

        // 自分の投稿一覧（Postテーブルから）
        $posts = Post::where('user_id', $user->id)->latest()->get();

        // 保存済み投稿（中間テーブル save_posts を通して）
        $savedPosts = $user->savePosts()->latest()->get();

        // Bladeに渡す（viewで使えるようにする）
        return view('mypage.my_journal', compact('posts', 'savedPosts'));
    }
}
