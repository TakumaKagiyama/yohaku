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

        $adminCode = $request->input('admin_code'); // ★ 追加：admin_codeの取得

        // 認証試行
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // セッション再生成（セキュリティ対策）

            // ★ 管理者コードが一致する場合は管理者画面へ
            if ($adminCode === env('ADMIN_CODE')) {
                return redirect()->route('admin.create');
            }

            // ★ 一般ユーザーの場合は一般ユーザー用画面へ
            return redirect()->route('welcome');
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
