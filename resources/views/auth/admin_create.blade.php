<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>TODAYS WORD - Admin</title>
    <link rel="stylesheet" href="{{ asset('css/admin_create.css') }}">
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
    <div class="admin-container">
        <div class="overlay">
            <h1 class="title">TODAYS WORD</h1>
            <h2 class="subtitle">ADMIN PAGE</h2>

            <form action="{{ route('admin.post') }}" method="POST" class="admin-form">
                @csrf
                @if(session('success'))
        <p style="color: green; margin-top: 10px;">{{ session('success') }}</p>
    @endif

    @if($errors->any())
        <ul style="color: red; margin-top: 10px;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
                <input type="text" name="theme" placeholder="今日のテーマを入力してください" required>
                <button type="submit">POST</button>
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
