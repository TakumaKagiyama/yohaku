<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
<<<<<<< Updated upstream
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\SeenPost;
use App\Models\Genre;

class PostController extends Controller
{
    // 🔹 投稿表示
    public function index()
    {
        $userId = Auth::id();

        // すでに見た投稿のIDを取得
        $seenPostIds = SeenPost::where('user_id', $userId)->pluck('post_id')->toArray();

        // 未読の投稿を1件ランダム取得
        $post = Post::whereNotIn('id', $seenPostIds)->inRandomOrder()->first();

        // ジャンル一覧を取得（必要ならビューで使える）
        $genres = Genre::pluck('name')->toArray();

        return view('posts.index', compact('post', 'genres'));
    }

    // 🔹 投稿保存
=======
//以下、川上が書き込ました
use App\Models\Post; // ← Postモデルを使うなら必要
use App\Models\Genre;


class PostController extends Controller
{
>>>>>>> Stashed changes
    public function store(Request $request)
    {
        $request->validate([
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'content' => ['required', 'string', 'max:18'],
<<<<<<< Updated upstream
            'genre' =>  ['required', 'exists:genres,id'],
        ]);

        // 画像を保存（storage/app/public/images に保存）
=======
            //'genre' =>  ['required', 'exists:genres,id'],//← 一時的にコメントアウト・あとでジャンルできたらとる
        ]);

        // 画像を保存（storage/app/public/images に保存される）
>>>>>>> Stashed changes
        $imagePath = $request->file('image')->store('images', 'public');

        // 投稿データを保存
        Post::create([
            'image' => $imagePath,
            'content' => $request->content,
<<<<<<< Updated upstream
            'user_id' => Auth::id(),
            'genre_id' => $request->genre,
        ]);

        // リダイレクト
        return redirect()->route('mypage.my_journal')->with('success', '投稿が完了しました！');
    }

    //editメソッド
    public function edit(Post $post)
    {
        $genres = Genre::all(); // ← selectタグに使う
        return view('posts.edit', compact('post', 'genres'));
    }

    //updateメソッド
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'content' => ['required', 'string', 'max:18', 'regex:/^[^!-/:-@¥[-`{-~]+$/u'],
            'genre' => ['required', 'exists:genres,id'],
        ]);

        // 画像が変更された場合のみ保存
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $post->image = $imagePath;
        }

        $post->content = $request->input('content');
        $post->genre_id = $request->input('genre');
        $post->save();

        return redirect()->route('mypage.my_journal')->with('success', '投稿が更新されました！');

        // 投稿削除メソッド
public function destroy(Post $post)
{
    // 投稿を削除
    $post->delete();

    return redirect()->route('mypage.my_journal')->with('success', '投稿が削除されました！');
}
    }
=======
            'user_id' => auth()->id(), 
            //'genre_id' => null, // ← 一時的に null に,ジャンル合体したあとでとる//$request->genre,// ← name="genre" の値を genre_id に入れる
        ]);

        // 保存完了後のリダイレクト
        return redirect()->route('mypage.my_journal')->with('success', '投稿が完了しました！');
    }
>>>>>>> Stashed changes
}
