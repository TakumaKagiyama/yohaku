<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// トップページアクセスでログイン画面へリダイレクト
Route::get('/', function () {
    return redirect('/login');
});

// ログインフォーム表示
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// ログイン処理
Route::post('/login', function (Request $request) {
    $credentials = $request->only('username', 'password'); // 'email'に変更してもOK

    if (Auth::attempt($credentials)) {
        return redirect()->intended('/welcome'); // 認証後は welcome に移動
    }

    return back()->with('error', 'usernameまたはpasswordが違います');
});

// ログアウト処理
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

// 認証後に表示する welcome ページ
Route::get('/welcome', function () {
    return view('welcome');
})->middleware('auth')->name('welcome');

// 投稿ページ（必要に応じて）
Route::get('/post', function () {
     $post = Post::latest()->first(); // 最新の投稿1件を取得（nullになる可能性あり）
    $genres = ['きょうのこと', 'ふと思った', 'ことばあそび', 'ぼんやりと', '心の中', '存在感', 'きれい', 'うらやましい']; // ジャンル例

    return view('layouts.post', [
        'post' => $post,
        'genres' => $genres
    ]);
})->name('post');

// プロフィールなどの認証必須ルート
    // ログインなしでアクセスOKにする
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
Route::post('/profile/image', [ProfileController::class, 'updateImage'])->name('profile.image.update');


Route::get('/todaysword', function () {
    return view('layouts.todaysword');
})->name('todaysword');

Route::post('/post', [PostController::class, 'store'])->name('post.store');

require __DIR__.'/auth.php';

