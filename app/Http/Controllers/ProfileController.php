<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;
use App\Models\SavePost;

class ProfileController extends Controller
{
    /**
     * プロフィール編集画面を表示
     */
    public function edit()
    {

        if (!Auth::user()) {
            return redirect('/login'); // 未ログインならログインページへリダイレクト
        }

        return view('mypage.profile_edit');
    }

    /**
     * 名前・メール・パスワードを更新
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        $user->fill($request->validated());

        // メール変更されたら確認リセット
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // パスワードが入力されていれば更新
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return Redirect::route('mypage.my_journal')->with('status', 'プロフィールを更新しました');
    }

    /**
     * プロフィール画像のアップロード処理
     */
    public function updateImage(Request $request): RedirectResponse
    {
        // dd($request);
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // ✅ ステップ1：画像がアップロードされているか確認
        if (!$request->hasFile('profile_image')) {
            return back()->withErrors(['profile_image' => '画像が選択されていません']);
        }

        // ✅ ステップ2：届いたファイルの情報を表示（一時的）
        // dd($request->file('profile_image'));

        // ※以下は今は通りません（確認後に有効化します）
        $request->validate([
            'profile_image' => 'required|image|max:2048',
        ]);

        if ($request->hasFile('profile_image')) {
            // dd($request->file('profile_image'));
            // 以前の画像を削除（任意）
            if ($user->profile_image) {
                Storage::disk('public')->delete($user->profile_image);
            }

            // 新しい画像を保存
            $path = $request->file('profile_image')->store('profile_images', 'public');
            $user->profile_image = $path;
            $user->save();
            // dd($user->profile_image);
            return Redirect::route('mypage.profile_edit')->with('status', 'プロフィール画像を更新しました');
        }

        return back()->withErrors(['profile_image' => '画像のアップロードに失敗しました']);
    }

    /**
     * アカウント削除（任意）
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }


    public function journal()
    {
        $user = Auth::user();

        if (!$user) {
        return redirect('/login'); // 未ログインならログインページへリダイレクト
    }

        $myPosts = Post::where('user_id', $user->id)
            ->with('genre')
            ->latest()
            ->get();

        // 保存済み投稿一覧 → SavePost から post を取り出す
        $savedPosts = SavePost::with('post.genre')
            ->where('user_id', $user->id)
            ->latest()
            ->get()
            ->pluck('post');  // ← post だけ抽出！

        return view('mypage.my_journal', [
            'posts' => $myPosts,
            'savedPosts' => $savedPosts,
        ]);
    }
}
