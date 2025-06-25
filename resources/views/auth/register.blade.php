<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
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
    <!-- ログインに戻るリンク -->
    <div class="login-link">
        <a href="{{ route('login') }}">LOGIN</a>
    </div>
    <div class="register-background">
        <div class="register-box">
            <h2>CREATE ACCOUNT</h2>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <input type="text" name="name" placeholder="Name" value="{{ old('name') }}" required>
                @error('name')
                    <div class="error">{{ $message }}</div>
                @enderror

                <!-- Email -->
                <input type="email" name="email" placeholder="Address" value="{{ old('email') }}" required>
                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror

                <!-- Password -->
                <input type="password" name="password" placeholder="Password" required>
                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror

                <!-- Confirm Password -->
                <input type="password" name="password_confirmation" placeholder="Repass" required>
                @error('password_confirmation')
                    <div class="error">{{ $message }}</div>
                @enderror

                <button type="submit">REGISTER</button>
            </form>
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
