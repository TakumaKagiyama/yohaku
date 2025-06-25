<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use App\Models\SeenPost;
use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;





// @@ -29,38 +28,21 @@ public function index()

// 🔹 投稿保存
//以下、川上が書き込ました
use App\Models\Post; // ← Postモデルを使うなら必要
use App\Models\Genre;


class PostController extends Controller
{
    // 🔹 投稿表示
    public function index(Request $request)
{
    $userId = Auth::id();
    $seenPostIds = SeenPost::where('user_id', $userId)->pluck('post_id')->toArray();

    if ($request->has('current')) {
        $currentPostId = $request->input('current');

        if ($currentPostId && Post::find($currentPostId)) {
            if (!in_array($currentPostId, $seenPostIds)) {
                SeenPost::create([
                    'user_id' => $userId,
                    'post_id' => $currentPostId,
                ]);
                $seenPostIds[] = $currentPostId;
            }
        }
    }

    $post = Post::whereNotIn('id', $seenPostIds)->inRandomOrder()->first();
    $genres = Genre::all();

    return view('posts.index', compact('post', 'genres'));
}




    // 投稿作成画面表示
    public function create()
    {
        $genres = Genre::all(); // ← genresテーブルから全部取得
        return view('posts.create', compact('genres')); // ← create.bladeに渡す
    }


    // 🔹 投稿保存
    public function store(Request $request)
    {
        // 今日すでに投稿しているか確認
        $alreadyPostedToday = DB::table('posts')
            ->where('user_id', Auth::id())
            ->whereDate('created_at', Carbon::today())
            ->exists();

        if ($alreadyPostedToday) {
            return redirect()->back()->withErrors(['error' => '投稿は1日1回までです。明日また投稿してください。'])->withInput();
        }

        // 通常のバリデーション
        $request->validate([
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'content' => ['required', 'string', 'max:18', 'regex:/^[^!-\~]+$/u'],
            'genre' => ['required', 'exists:genres,id'],
        ]);

        // 画像保存
        $imagePath = $request->file('image')->store('images', 'public');

        // 投稿保存
        Post::create([
            'image' => $imagePath,
            'content' => $request->content,

            'user_id' => Auth::id(),
            'genre_id' => $request->genre,
        ]);

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
            'content' => ['required', 'string', 'max:18', 'regex:/^[^!-\~]+$/u'],
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
    }
    // 投稿削除メソッド
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('mypage.my_journal')->with('success', '投稿を削除しました');
    }

    //
    public function filterByGenre(Request $request, $genre_id)
    {
        $currentPostId = $request->input('current');

        $query = Post::where('genre_id', $genre_id)->orderBy('id');

        if ($currentPostId) {
            $post = $query->where('id', '>', $currentPostId)->first();
        } else {
            $post = $query->first();
        }

        $genres = Genre::all();

        return view('posts.index', compact('post', 'genres'));
    }
}
