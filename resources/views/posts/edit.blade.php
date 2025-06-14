<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>TODAY'S WORD - Edit</title>
    <link rel="stylesheet" href="{{ asset('css/todaysword.css') }}">
</head>
<body>
    <div class="wrapper">
        <div class="title">TODAY'S WORD - 編集</div>

        <form class="form" method="POST" action="#" enctype="multipart/form-data">
            @csrf
            {{-- 投稿画像 --}}
            <div class="form-row">
                <label for="image" class="image-upload">
                    <div class="image-box">
                        <img src="{{ asset('images/upload_icon.png') }}" alt="Upload">
                    </div>
                    <input type="file" name="image" id="image" style="display: none;">
                </label>

                {{-- ことば入力 --}}
                <input type="text" name="word" class="word-input" placeholder="ことば（18文字以内）">
            </div>

            {{-- TAGS + POST + DELETE --}}
            <div class="form-bottom three-buttons">
                <select name="tag" class="tag-select">
                    <option value="">TAGS</option>
                    <option value="感情">感情</option>
                    <option value="風景">風景</option>
                    <option value="宇宙">宇宙</option>
                </select>

                <button type="submit" class="post-button">POST</button>

                <button type="button" class="delete-button" onclick="alert('削除処理は未実装です')">DELETE</button>
            </div>
        </form>
    </div>
</body>
</html>
