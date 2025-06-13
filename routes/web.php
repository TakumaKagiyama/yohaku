<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController; 
use Illuminate\Support\Facades\Route;
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

// ▼▼▼▼▼ 認証なしでアクセスできるように変更 ▼▼▼▼▼ 今後、authの追加が必要

// welcome ページ（認証なし）
Route::get('/welcome', function () {
    return view('layouts.welcome');
})->name('welcome');

// todaysword ページ（認証なし）
Route::get('/todaysword', function () {
    return view('layouts.todaysword');
})->name('todaysword');

// todaysword_edit ページ（認証なし）
Route::get('/todaysword/edit', function () {
    return view('layouts.todaysword_edit');
})->name('todaysword.edit');

// ▲▲▲▲▲ 認証なしでアクセスできるように変更 ▲▲▲▲▲

// 投稿処理（コントローラー経由）
Route::post('/post', [PostController::class, 'store'])->name('post.store');

// 投稿ページ（仮置き）
Route::get('/post', function () {
    return '投稿ページ';
});

// プロフィールなどの認証必須ルート
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/profile/edit', function () {
    return view('layouts.profile');
})->name('profile.edit');

require __DIR__.'/auth.php';
