<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>ログイン</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body>
    <!-- 右上の新規登録ボタン -->
    <div class="register-link">
        <a href="{{ route('register') }}">REGISTER</a>
    </div>
    <div class="login-background">
        <div class="login-box">
            <h2>LOGIN</h2>
            @if (session('error'))
                <div class="error">{{ session('error') }}</div>
            @endif
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <input type="text" name="name" placeholder="username" required>
                <input type="password" name="password" placeholder="password" required>
                <!-- 管理者コード入力欄 -->
                <div class="form-group">
                    <label for="admin_code">admin pass</label>
                    <!--<input type="text" name="admin_code" placeholder="admin pass" required>-->
                    <input type="text" name="admin_code" id="admin_code" class="form-control">
                </div>
                <button type="submit">LOGIN</button>

            </form>
            @if ($errors->any())
                <div class="error">
                    {{ $errors->first() }}
                </div>
            @endif
        </div>
    </div>
</body>

</html>
