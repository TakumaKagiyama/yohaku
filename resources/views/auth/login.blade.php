<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>ログイン</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

@php
    $hour = now()->format('H'); // 時間を 00～23 で取得
    if ($hour >= 5 && $hour < 12) {
        $timeClass = 'morning';
    } elseif ($hour >= 12 && $hour < 18) {
        $timeClass = 'afternoon';
    } else {
        $timeClass = 'night';
    }
@endphp

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
                    <input type="text" name="admin_code" id="admin_code" class="form-control" placeholder="Admin Pass (Admin Only)">
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

<script>
    // ページが表示されたときに動く
    window.addEventListener('DOMContentLoaded', function () {
        // 現在の時間（0〜23）を取得（0は深夜0時、13は午後1時など）
        const hour = new Date().getHours();

        // bodyタグを取得（背景を変えるために）
        const body = document.body;

        // 朝（5時〜11時）
        if (hour >= 5 && hour < 12) {
            body.classList.add('background', 'morning');
        }
        // 昼（12時〜17時）
        else if (hour >= 12 && hour < 18) {
            body.classList.add('background', 'afternoon');
        }
        // 夜（18時〜翌朝4時）
        else {
            body.classList.add('background', 'night');
        }
    });
</script>

</html>
