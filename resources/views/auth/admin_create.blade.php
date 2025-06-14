<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>TODAYS WORD - Admin</title>
    <link rel="stylesheet" href="{{ asset('css/admin_create.css') }}">
</head>

<body>
    <div class="admin-container">
        <div class="overlay">
            <h1 class="title">TODAYS WORD</h1>
            <h2 class="subtitle">ADMIN PAGE</h2>

            <form action="{{ route('admin.post') }}" method="POST" class="admin-form">
                @csrf
                <input type="text" name="theme" placeholder="今日のテーマを入力してください" required>
                <button type="submit">POST</button>
            </form>
        </div>
    </div>
</body>

</html>
