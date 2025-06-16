<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Post;

// auth機能あり
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| ページのURLルーティングを定義します。表示するbladeファイルと結びつけます。
|--------------------------------------------------------------------------
*/

// // 🔸【1】トップページ（アクセス時にログイン画面へリダイレクト）
// Route::get('/', function () {
//     return redirect('/login');
// });

// // 🔸【2】ログインページ（Blade: auth/login.blade.php）
// Route::get('/login', function () {
//     return view('auth.login');
// })->name('login');

// // 🔸【3】ログイン処理（POST）
// Route::post('/login', function (Request $request) {
//     $credentials = $request->only('username', 'password');

//     if (Auth::attempt($credentials)) {
//         return redirect()->intended('/welcome');
//     }

//     return back()->with('error', 'ユーザー名またはパスワードが違います');
// });

// // 🔸【4】ログアウト処理（POST）
// Route::post('/logout', function () {
//     Auth::logout();
//     return redirect('/login');
// })->name('logout');

// // 🔸【5】初回説明ページ（Blade: welcome.blade.php）
// Route::get('/welcome', function () {
//     return view('welcome');
// })->name('welcome');

// 🔸【6】新規登録ページ（Blade: auth/register.blade.php）
// Route::get('/register', function () {
//     return view('auth.register');
// })->name('register');

// // 🔸【7】管理者投稿編集ページ（Blade: auth/admin_create.blade.php）
// Route::get('/admin/create', function () {
//     return view('auth.admin_create');
// })->name('admin.create');

// // 🔸【8】投稿作成ページ（写真と言葉の投稿画面）
// //        Blade: posts/create.blade.php
// Route::get('/post/create', function () {
//     return view('posts.create');
// })->name('post.create');

// // 🔸【9】投稿編集ページ（Blade: posts/edit.blade.php）
// Route::get('/post/edit', function () {
//     return view('posts.edit');
// })->name('post.edit');

// 🔹投稿編集画面（edit.blade.php）へのルート
// Route::get('/post/edit', function () {
//     return view('posts.edit');
// })->name('post.edit');

// // 🔸【10】投稿一覧（1件拡大表示）
// //         Blade: posts/index.blade.php
// Route::get('/post', function () {
//     return view('posts.index');
// })->name('post.index');

// 🔸【11】アーカイブ（非公開投稿一覧）
//         Blade: posts/archive.blade.php
// Route::get('/archive', function () {
//     return view('posts.archive');
// })->name('post.archive');

// // 🔸【12】投稿データを保存（PostController使用）
// Route::post('/post', [PostController::class, 'store'])->name('post.store');

// // 🔸【13】マイページ（投稿/保存/履歴）
// //         Blade: mypage/my_journal.blade.php
// Route::get('/mypage/journal', function () {
//     return view('mypage.my_journal');
// })->name('mypage.journal');

// // 🔸【14】表示モード切替ページ（自己投稿・保存・両方）
// //         Blade: mypage/my_mode.blade.php
// Route::get('/mypage/mode', function () {
//     return view('mypage.my_mode');
// })->name('mypage.mode');

// 🔸【15】プロフィール編集ページ（Controller経由）
//         Blade: mypage/profile_edit.blade.php
// Route::get('/mypage/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');

// // 🔸【16】プロフィール更新処理（PUT）
// Route::put('/mypage/profile/update', [ProfileController::class, 'update'])->name('profile.update');

// // 🔸【17】プロフィール画像更新処理（POST）
// Route::post('/mypage/profile/image', [ProfileController::class, 'updateImage'])->name('profile.image.update');

// 🔸【18】プロフィール編集ページ（Blade直接表示版 ※Controller不要）
//         Blade: mypage/profile_edit.blade.php
// Route::get('/mypage/profile/edit-view', function () {
//     return view('mypage.profile_edit');
// })->name('profile.edit.view');

// 管理者投稿ページ（ログインが必要）
// Route::middleware(['auth'])->group(function () {
//     Route::get('/admin/create', function () {
//         return view('auth.admin_create');
//     })->name('admin.create');

//     Route::post('/admin/post', function (\Illuminate\Http\Request $request) {
//         // ここに保存処理（例: テーマをDBに保存）
//         // 例: AdminPost::create(['theme' => $request->theme]);
//         return back()->with('message', '投稿されました');
//     })->name('admin.post');
// });

// 🔸【19】Laravel Breezeなどの認証ルートファイル
// require __DIR__ . '/auth.php';

// auth機能なし
// 🔹【1】トップページ → ログイン画面にリダイレクト
Route::get('/', function () {
    return redirect('/login');
});

// 🔹【2】ログイン画面（auth/login.blade.php）
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// 🔹【3】ログイン処理
Route::post('/login', function (Request $request) {
    $credentials = $request->only('username', 'password');

    if (Auth::attempt($credentials)) {
        return redirect()->intended('/welcome');
    }

    return back()->with('error', 'ユーザー名またはパスワードが違います');
});

// 🔹【4】ログアウト処理
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

// 🔹【5】初回説明ページ（welcome.blade.php）
Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

// 🔹【6】新規登録ページ（auth/register.blade.php）
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

// 🔹【7】管理者用編集画面（auth/admin_create.blade.php）
Route::get('/admin/create', function () {
    return view('auth.admin_create');
})->name('admin.create');

// 🔹【8】投稿作成画面（posts/create.blade.php）
Route::get('/post/create', function () {
    return view('posts.create');
})->name('post.create');

// 🔹【9】投稿編集画面（posts/edit.blade.php）
Route::get('/post/edit', function () {
    return view('posts.edit');
})->name('post.edit');

// 🔹投稿編集画面（edit.blade.php）へのルート
Route::get('/post/edit', function () {
    return view('posts.edit');
})->name('post.edit');

// 🔹【10】投稿詳細一覧（posts/index.blade.php）
Route::get('/post/index', function () {
    return view('posts.index');
})->name('post.index');

// 🔹【11】アーカイブページ（posts/archive.blade.php）
Route::get('/archive', function () {
    return view('posts.archive');
})->name('post.archive');

// 🔹【12】投稿データ保存（PostController）
Route::post('/post', [PostController::class, 'store'])->name('post.store');

// 🔹【13】マイページ（投稿/保存/履歴）mypage/my_journal.blade.php
Route::get('/mypage/my_journal', function () {
    return view('mypage.my_journal');
})->name('mypage.my_journal');

// 🔹【14】モード切替ページ（mypage/my_mode.blade.php）
Route::get('/mypage/mode', function () {
    return view('mypage.my_mode');
})->name('mypage.mode');

// 🔹【15】プロフィール編集ページ（mypage/profile_edit.blade.php）
Route::get('/mypage/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');

// 🔹【16】プロフィール情報更新（PUT）
Route::put('/mypage/profile/update', [ProfileController::class, 'update'])->name('profile.update');

// 🔹【17】プロフィール画像アップロード処理（POST）
Route::post('/mypage/profile/image', [ProfileController::class, 'updateImage'])->name('profile.image.update');

// 🔹【18】直接View表示のプロフィール画面（controller使わずBlade直表示）
Route::get('/mypage/profile/edit-view', function () {
    return view('mypage.profile_edit');
})->name('profile.edit.view');

// 認証不要でアクセス可能な管理者投稿ページ
Route::get('/admin/create', function () {
    return view('auth.admin_create');
})->name('admin.create');

Route::post('/admin/post', function (\Illuminate\Http\Request $request) {
    // バリデーション例（任意）
    $request->validate([
        'theme' => 'required|max:255',
    ]);

    // ここに保存処理（例: DB保存など）
    // 例: AdminPost::create(['theme' => $request->theme]);

    return back()->with('message', '投稿されました');
})->name('admin.post');

// 🔹【19】Laravel認証のルート（未使用でもOK）
require __DIR__ . '/auth.php';
