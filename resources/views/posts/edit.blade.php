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
            {{-- 画像アップロード --}}
            <label for="image" class="image-upload">
                <input type="file" name="image" id="image" accept="image/*" hidden>
                <div class="image-box">
                    <img src="{{ asset('storage/' . $post->image) }}" alt="Image Preview" style="display: block;">
                    <span class="upload-text">クリックして画像を変更</span>
                </div>
            </label>

            {{-- 入力＋ヒント＋ジャンル --}}
            <div class="input-group">
                <input type="text" name="content" class="word-input" maxlength="18"
                       value="{{ old('content', $post->content) }}"
                       required pattern="^[^!-/:-@¥[-`{-~]+$">
                <p id="hint" class="hint-text">※ 記号（！や＠や％など）は使えません</p>

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

                    <button type="submit" class="post-button">更新</button>
                </div>
            </div>
        </div>
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
</html>
