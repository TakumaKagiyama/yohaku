<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SavePost;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class SavePostController extends Controller
{
    // 保存処理
    public function store($id)
    {
        SavePost::firstOrCreate([
            'user_id' => Auth::id(),
            'post_id' => $id,
        ]);

        return redirect()->route('post.index')->with('message', '保存しました');
    }

    // 保存一覧表示
    public function index()
    {
        $savedPosts = SavePost::with('post')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('mypage.saved', compact('savedPosts'));
    }
}
