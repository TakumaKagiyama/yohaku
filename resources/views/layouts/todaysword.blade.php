<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>TODAYS WORD</title>
    <link rel="stylesheet" href="{{ asset('css/todaysword.css') }}">
</head>
<body>
    <div class="container">
        <h1 class="title">TODAYS WORD</h1>
        <form method="POST" action="{{ route('post.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-box">
                <label for="image-upload" class="image-label">
                    <img src="{{ asset('images/image-icon.png') }}" alt="Upload" class="icon">
                </label>
                <input type="file" name="image" id="image-upload" class="image-input" hidden>

                <input type="text" name="text" maxlength="18" placeholder="18文字以内のことば" class="text-input" required>

                <select name="tag" class="tag-select">
                    <option value="">TAGS</option>
                    <option value="感情">感情</option>
                    <option value="風景">風景</option>
                    <option value="日常">日常</option>
                    <!-- 他のタグを追加可能 -->
                </select>

                <button type="submit" class="post-button">POST</button>
            </div>
        </form>
    </div>
</body>
</html>
