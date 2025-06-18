<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // 登録画面を表示
    public function show()
    {
        return view('auth.register'); // ファイル名に合わせてパス変更
    }

    // 登録処理
    public function register(Request $request)
    {
        // バリデーション
        $request->validate([
            'name' => 'required|max:30',
            'email' => 'required|email|max:100|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        // ユーザー登録
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // ハッシュ化
            'is_admin' => false,
        ]);



        // 登録完了後ログイン画面へ
        return redirect('/login')->with('success', 'アカウント登録が完了しました！');
    }
}
