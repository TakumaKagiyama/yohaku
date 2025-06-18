<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // ログインフォームの表示
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // ログイン処理
    public function login(Request $request)
    {
        // バリデーション
        $request->validate([
        'name' => ['required', 'string'],
        'password' => ['required'],
    ]);

    // 明示的にnameとpasswordを渡す（username()メソッドに依存しない）
    $credentials = [
        'name' => $request->input('name'),
        'password' => $request->input('password'),
    ];

        // 認証試行
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // セッション再生成（セキュリティ対策）
            return redirect()->intended('/welcome'); // ログイン成功後に /welcome へ
        }

        // 認証失敗時
        return back()->withErrors([
            'name' => 'ユーザー名またはパスワードが正しくありません。',
        ]);
    }

    // ログアウト処理
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function username()
{
    return 'name';
}
}
