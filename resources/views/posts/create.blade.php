{{-- <!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>TODAYS WORD</title>
    <link rel="stylesheet" href="{{ asset('css/todaysword.css') }}">
</head>

<body>
    <div class="wrapper">
        <h1 class="title">
            {{ $theme->text ?? '今日のことばがまだ設定されていません' }}
        </h1> --}}

        {{-- <form method="POST" action="{{ route('post.store') }}" enctype="multipart/form-data" class="form">
            @csrf --}}

            {{-- エラー表示 --}}
            {{-- @if ($errors->any())
                <div class="error-messages">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li style="color:red;">{{ $error }}</li>
                        @endforeach
                    </ul> --}}

                    {{-- 🔻 1日1回制限のときだけボタン表示
                    @if ($errors->has('error') && $errors->first('error') === '投稿は1日1回までです。明日また投稿してください。')
                        <div class="error-actions" style="margin-top: 1em;">
                            <a href="{{ route('mypage.my_journal') }}" class="btn">MYPAGE</a>
                            <a href="{{ url('/post') }}" class="btn" style="margin-left: 1em;">HOME</a>
                        </div>
                    @endif
                </div>
            @endif --}}

            {{-- すでに投稿したかどうか --}}
            {{-- @if ($alreadyPostedToday)
            <div class="already-posted-message">
            <p style="color:red;">投稿は1日1回までです。明日また投稿してください。</p>
            <div class="error-actions" style="margin-top: 1em;">
            <a href="{{ route('mypage.my_journal') }}" class="btn">MYPAGE</a>
            <a href="{{ url('/post') }}" class="btn" style="margin-left: 1em;">HOME</a>
            </div>
            </div>
            @else --}}
            {{-- 投稿フォームを表示する --}}
            {{-- <form method="POST" action="{{ route('post.store') }}" enctype="multipart/form-data" class="form">
            @csrf --}}

            {{-- <div class="form-row"> --}}
                {{-- 左：画像アップロード --}}
                {{-- <label for="image" class="image-upload">
                    <input type="file" name="image" id="image" accept="image/*" hidden required>
                    <div class="image-box">
                        <img src="{{ asset('images/icon-image.png') }}" alt="Image Icon">
                        <span class="upload-text">クリックして画像を選択</span>
                    </div>
                </label> --}}

                {{-- 右：入力＋ヒント＋ボタン --}}
                {{-- <div class="input-group">
                    {{-- ことば入力 --}}
                    {{-- <input type="text" name="content" class="word-input" maxlength="18" placeholder="18文字以内のことば"
                        required pattern="^[^!-/:-@¥[-`{-~]+$">
                    <p id="hint" class="hint-text">※ 記号（！や＠や％など）は使えません</p> --}}

                    {{-- 下にジャンルとPOSTボタン --}}
                    {{-- <div class="form-bottom">

                        <select name="genre" class="tag-select" required>
                            <option value="">ジャンルを選択</option>
                            @foreach ($genres as $genre) 
                                <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="post-button">POST</button>
                    </div>
                </div>
            </div> --}}
        {{-- </form> 
        @endif

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
                        reader.readAsDataURL(file); --}}
                    {{-- } else {
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
                        hintText.style.display = 'block'; --}}
                    {{-- }
                }); --}}
            {{-- </script>

</body>

</html> --}}

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>TODAYS WORD</title>
    <link rel="stylesheet" href="{{ asset('css/todaysword.css') }}">
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
    <div class="wrapper">
        <h1 class="title">
            {{ $theme->text ?? '今日のことばがまだ設定されていません' }}
        </h1>

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

        {{-- すでに投稿したかどうか --}}
        @if ($alreadyPostedToday)
            <div class="already-posted-message">
                <p style="color:red;">投稿は1日1回までです。明日また投稿してください。</p>
                <div class="error-actions" style="margin-top: 1em;">
                    <a href="{{ route('mypage.my_journal') }}" class="btn">MYPAGE</a>
                    <a href="{{ url('/post') }}" class="btn" style="margin-left: 1em;">HOME</a>
                </div>
            </div>
        @else
            {{-- 投稿フォームを表示する --}}
            <form method="POST" action="{{ route('post.store') }}" enctype="multipart/form-data" class="form">
                @csrf

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
                        <input type="text" name="content" class="word-input" maxlength="18" placeholder="18文字以内のことば"
                            required pattern="^[^!-/:-@¥[-`{-~]+$">
                        <p id="hint" class="hint-text">※ 記号（！や＠や％など）は使えません</p>

                        <div class="form-bottom">
                            <select name="genre" class="tag-select" required>
                                <option value="">ジャンルを選択</option>
                                @foreach ($genres as $genre)
                                    <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="post-button">POST</button>
                        </div>
                    </div>
                </div>
            </form>
        @endif

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
                } else {
                    preview.style.display = "none";
                    uploadText.style.display = "block";
                }
            });

            const contentInput = document.querySelector('.word-input');
            const hintText = document.getElementById('hint');
            contentInput.addEventListener('input', function() {
                hintText.style.display = this.value.length > 0 ? 'none' : 'block';
            });
        </script>
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
