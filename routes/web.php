<?php

use App\Models\Theme;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SavePostController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Log;

use App\Models\Genre;


// auth機能あり
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| ページのURLルーティングを定義します。表示するbladeファイルと結びつけます。
|--------------------------------------------------------------------------
*/
// TinderページのMyPageを表示するルート
Route::get('/mypage/journal', function () {
    return view('mypage.my_journal');
});

// 登録画面の表示と登録処理の実行
Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// ログインの処理
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/admin/create', function () {
    return view('auth.admin_create');
})->name('admin.create');

Route::get('/welcome', function () {
    $latestTheme = \App\Models\Theme::latest()->first(); // ← 追加
    return view('welcome', ['theme' => $latestTheme]);    // ← 修正
})->middleware('auth')->name('welcome'); // ログインしていないとアクセス不可

// プロフィール編集ページと更新処理
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

// 管理者からテーマを保存する処理
Route::post('/admin/post', function (\Illuminate\Http\Request $request) {
    $request->validate([
        'theme' => 'required|max:255',
    ]);
    // ✅ テーマをDBに保存する処理
    Theme::create(['text' => $request->theme]);
    // ✅ 保存後、welcomeページにリダイレクト
    return redirect()->route('welcome')->with('message', '投稿されました');
})->name('admin.post');

Route::post('/admin/post', function (\Illuminate\Http\Request $request) {
    Log::info('Admin post received', $request->all());
    $request->validate([
        'theme' => 'required|max:255',
    ]);
    \App\Models\Theme::create(['text' => $request->theme]);
    return redirect()->route('welcome')->with('message', '投稿されました');
})->name('admin.post');

// 消しても良いかも！！！！！！
// Route::post('/admin/post', function (Request $req) {
//     Theme::create(['text' => $req->theme]);
//     return redirect()->route('welcome');
// })->name('admin.post');


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
// Route::get('/', function () {
//     return redirect('/login');
// });

// 🔹【7】管理者用編集画面（auth/admin_create.blade.php）
Route::get('/admin/create', function () {
    return view('auth.admin_create');
})->name('admin.create');

// 🔹【8】投稿作成画面（posts/create.blade.php）
Route::get('/post/create', function () {
    $genres = Genre::all(); // ← DBからジャンル一覧を取得
    return view('posts.create', compact('genres')); // ← Bladeに渡す
})->name('post.create');


//🔹【9】は内容がかぶってたので削除しました！


// 投稿編集画面の表示（posts/edit.blade.php）← 投稿ID付きで呼び出せる
Route::get('/post/edit/{post}', [PostController::class, 'edit'])->name('post.edit');

// 投稿内容の更新処理（編集フォームの送信先）
Route::post('/post/update/{post}', [PostController::class, 'update'])->name('post.update');

// 投稿削除（Destroy）
Route::delete('/post/delete/{post}', [PostController::class, 'destroy'])->name('post.destroy');


// 投稿閲覧画面：未読からランダム1件取得して表示
Route::get('/post', [PostController::class, 'index'])->name('post.index');


// 投稿の保存処理（SAVEボタン） ※コントローラー側で処理
Route::post('/post/{id}/save', [SavePostController::class, 'store'])->name('post.save');
Route::get('/mypage/save', [SavePostController::class, 'index'])->name('post.saved');

// 投稿の既読登録処理（NEXTボタン）※コントローラー側で処理
Route::post('/post/seen', [PostController::class, 'seen'])->name('post.seen');


// // 🔹【HOME】トップページ（posts/index.blade.php に変更）

// 🔹【HOME】トップページ（posts/index.blade.php に変更）

// Route::get('/', function () {
//     return view('posts.index'); // ← ここを変更！
// })->name('home');

// 🔹【HOME】トップページ（posts/index.blade.php に変更）
Route::get('/', function () {
    return view('posts.index');
})->name('home');

// 🔹【11】アーカイブページ（posts/archive.blade.php）
Route::get('/archive', function () {
    return view('posts.archive');
})->name('post.archive');

// 🔹【12】投稿データ保存（PostController）
Route::post('/post', [PostController::class, 'store'])->name('post.store');

// 🔹【13】マイページ（投稿/保存/履歴）mypage/my_journal.blade.php
Route::get('/mypage/my_journal', [ProfileController::class, 'journal'])->name('mypage.my_journal');


// 🔹【14】モード切替ページ（mypage/my_mode.blade.php）
Route::get('/mypage/mode', function () {
    return view('mypage.my_mode');
})->name('mypage.mode');

// 🔹【15】プロフィール編集ページ（mypage/profile_edit.blade.php）
// Route::get('/mypage/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::get('/mypage/profile_edit', function () {
    return view('mypage.profile_edit');
})->name('mypage.profile_edit');

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

// 🔹【19】Laravel認証のルート（未使用でもOK）
// require __DIR__ . '/auth.php';
