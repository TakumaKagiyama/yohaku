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

            {{-- エラー表示 --}}
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
                {{-- 左：画像アップロード --}}
                <label for="image" class="image-upload">
                    <input type="file" name="image" id="image" accept="image/*" hidden required>
                    <div class="image-box">
                        <img src="{{ asset('images/icon-image.png') }}" alt="Image Icon">
                        <span class="upload-text">クリックして画像を選択</span>
                    </div>
                </label>

                {{-- 右：入力＋ヒント＋ボタン --}}
                <div class="input-group">
                    {{-- ことば入力 --}}
                    <input type="text" name="content" class="word-input" maxlength="18" placeholder="18文字以内のことば"
                        required pattern="^[^!-/:-@¥[-`{-~]+$">
                    <p id="hint" class="hint-text">※ 記号（！や＠や％など）は使えません</p>

                    {{-- 下にジャンルとPOSTボタン --}}
                    <div class="form-bottom">
<<<<<<< Updated upstream
                        
                        <select name="genre" class="tag-select" required>
=======
                        {{-- ジャンル機能が整ってから再表示する --}}
                        {{--<select name="genre" class="tag-select" required>
>>>>>>> Stashed changes
                            <option value="">ジャンルを選択</option>
                            @foreach ($genres as $genre)
                                <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                            @endforeach
<<<<<<< Updated upstream
                        </select>
=======
                        </select>--}}
>>>>>>> Stashed changes
                        <button type="submit" class="post-button">POST</button>
                    </div>
                </div>
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
                            preview.style.display = "block"; // ← 表示する
                            uploadText.style.display = "none"; // ← テキストを消す
                        };
                        reader.readAsDataURL(file);
                    } else {
                        // 無効なファイルのときは非表示に戻す
                        preview.style.display = "none";
                        uploadText.style.display = "block";
                    }
                });

                // 🔻ことば入力時にヒントを消す処理
                const contentInput = document.querySelector('.word-input');
                const hintText = document.getElementById('hint');

                contentInput.addEventListener('input', function() {
                    if (this.value.length > 0) {
                        hintText.style.display = 'none';
                    } else {
                        hintText.style.display = 'block';
                    }
                });
            </script>




</body>

</html>
