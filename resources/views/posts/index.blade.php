<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>投稿</title>
    <link rel="stylesheet" href="{{ asset('css/post.css') }}">
</head>

<body>
    <div class="background">
        <div class="post-container">
            @isset($post)
                <div class="image-wrapper">
                    <img src="{{ $post->image_url ?? '/images/default.jpg' }}" alt="投稿画像">
                </div>
                <div class="text-wrapper">
                    <p>{{ $post->text ?? 'テキストなし' }}</p>
                    @if (!empty($post->tag))
                        <span class="tag">#{{ $post->tag }}</span>
                    @endif
                </div>
            @else
                <p>18文字以内のことば</p>
            @endisset
        </div>

        <div class="controller-grid">
            <a href="/mypage/journal">
                    <button id="up">MYPAGE</button></a>
            <div class="middle-row">
                <button id="left">SAVE</button>
                <button id="right">NEXT</button>
            </div>
            <button id="down">EDIT</button>
        </div>

        <div class="hamburger-menu" id="menu-toggle">
            <div></div>
            <div></div>
            <div></div>
        </div>

        <div class="genre-menu" id="genre-menu">
            <ul>
                @if (!empty($genres) && is_array($genres))
                    @foreach ($genres as $genre)
                        <li>{{ $genre }}</li>
                    @endforeach
                @else
                    <li>ジャンル未設定</li>
                @endif
            </ul>
        </div>
    </div>

    <script src="{{ asset('js/post.js') }}"></script>
</body>

</html>
