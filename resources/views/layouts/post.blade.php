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
            @if ($post)
                <div class="image-wrapper">
                    <img src="{{ $post->image_url }}" alt="投稿画像">
                </div>
                <div class="text-wrapper">
                    <p>{{ $post->text }}</p>
                    <span class="tag">#{{ $post->tag }}</span>
                </div>
            @else
                <p>18文字以内のことば</p>
            @endif


        </div>

        <div class="controller-grid">
            <button id="up">MYPAGE</button>
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
                @foreach ($genres as $genre)
                    <li>{{ $genre }}</li>
                @endforeach
            </ul>
        </div>
    </div>

    <script src="{{ asset('js/post.js') }}"></script>
</body>

</html>
