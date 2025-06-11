<!-- resources/views/welcome.blade.php -->
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>YOHAKU</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="background">
        <div class="overlay">
            <div class="title-box">
                <div class="title-main">YOHAKU</div>
                <div class="title-sub">今日のことばが入る予定</div>
            </div>
            <a href="/post" class="post-button">POST</a>
        </div>
    </div>
</body>
</html>
