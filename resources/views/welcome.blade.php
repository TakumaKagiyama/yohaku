<!-- resources/views/welcome.blade.php -->
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>YOHAKU</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
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
    <div class="background {{ $timeClass }}">
        <div class="overlay">
            <div class="title-box">
                <div class="title-main">YOHAKU</div>
                <div class="title-sub">
                    {{ $theme->text ?? '今日のことばがまだ設定されていません' }}
                </div>

            </div>

            <a href="/post/create" class="post-button">POST</a>

        </div>
    </div>
</body>
</html>
