<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>TODAYS WORD</title>
    <link rel="stylesheet" href="{{ asset('css/todaysword.css') }}">
</head>
<body>
    <div class="wrapper">
        <h1 class="title">TODAYS WORD</h1>

        <form method="POST" action="{{ route('post.store') }}" enctype="multipart/form-data" class="form">
            @csrf

            <div class="form-row">
                <label for="image" class="image-upload">
                    <input type="file" name="image" id="image" hidden>
                    <div class="image-box">
                        <img src="{{ asset('images/icon-image.png') }}" alt="Image Icon">
                    </div>
                </label>

                <input type="text" name="word" class="word-input" maxlength="18" placeholder="18文字以内のことば" required>
            </div>

            <div class="form-bottom">
                <select name="tag" class="tag-select">
                    <option value="">TAGS</option>
                    <option value="宇宙">宇宙</option>
                    <option value="夢">夢</option>
                    <option value="静けさ">静けさ</option>
                </select>

                <button type="submit" class="post-button">POST</button>
            </div>
        </form>
    </div>
</body>
</html>
