<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>TODAYS WORD - 編集</title>
    <link rel="stylesheet" href="{{ asset('css/todaysword.css') }}">
</head>

<body>
    <div class="wrapper">
        <h1 class="title">TODAYS WORD - 編集</h1>

        <!-- ✨ 更新フォーム -->
        <form method="POST" action="{{ route('post.update', $post->id) }}" enctype="multipart/form-data" class="form">
            @csrf

            @if ($errors->any())
                <div class="error-messages">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li style="color:red;">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-row">
                <!-- 画像アップロード -->
                <label for="image" class="image-upload">
                    <input type="file" name="image" id="image" accept="image/*" hidden>
                    <div class="image-box">
                        <img src="{{ asset('storage/' . $post->image) }}" alt="Image Preview" style="display: block;">
                        <span class="upload-text">クリックして画像を変更</span>
                    </div>
                </label>

                <!-- 入力エリア -->
                <div class="input-group">
                    <input type="text" name="content" class="word-input" maxlength="18"
                        value="{{ old('content', $post->content) }}" required pattern="^[^!-/:-@¥[-`{-~]+$">
                    <p id="hint" class="hint-text">※ 記号（！や＠や％など）は使えません</p>

                    <!-- 横並びボタンエリア -->
                    <div class="form-bottom">
                        <select name="genre" class="tag-select" required>
                            <option value="">ジャンルを選択</option>
                            @foreach ($genres as $genre)
                                <option value="{{ $genre->id }}"
                                    {{ $genre->id == $post->genre_id ? 'selected' : '' }}>
                                    {{ $genre->name }}
                                </option>
                            @endforeach
                        </select>

                        <!-- 更新ボタン -->
                        <button type="submit" class="post-button">UPDATE</button>
                    </div>
                </div>
            </div>
        </form>

        <!-- ✨ 完全に別の削除フォーム -->
        <form method="POST" action="{{ route('post.destroy', $post->id) }}" onsubmit="return confirm('本当に削除しますか？');"
            style="margin-top: 20px; display: flex; justify-content: center;">
            @csrf
            @method('DELETE')
            <button type="submit" class="post-button" style="background-color: #000; color: white;">
                DELETE
            </button>
        </form>



    </div>

    <script>
        document.getElementById('image').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const preview = document.querySelector('.image-box img');
            const uploadText = document.querySelector('.upload-text');

            if (file && file.type.startsWith("image/")) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    preview.src = event.target.result;
                    preview.style.display = "block";
                    uploadText.style.display = "none";
                };
                reader.readAsDataURL(file);
            }
        });

        const contentInput = document.querySelector('.word-input');
        const hintText = document.getElementById('hint');
        contentInput.addEventListener('input', function() {
            hintText.style.display = this.value.length > 0 ? 'none' : 'block';
        });
    </script>
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
