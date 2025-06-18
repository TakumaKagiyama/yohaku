<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>投稿一覧</title>
    <link rel="stylesheet" href="{{ asset('css/post.css') }}">
</head>

<body>
    <div class="background">
        <div class="post-container">
            @if ($post)
                <div class="image-wrapper">
                    <img src="{{ $post->image }}" alt="投稿画像">
                </div>
                <div class="text-wrapper">
                    <p>{{ $post->content }}</p>
                    @if ($post->genre)
                        <span class="tag">#{{ $post->genre->name }}</span>
                    @endif
                </div>
            @else
                <p>もうすべての投稿を見ました。</p>
            @endif
        </div>

        <div class="controller-grid">
            <a href="/mypage/journal">
                <button id="up">MYPAGE</button>
            </a>
            <div class="middle-row">
                <form method="POST" action="{{ route('post.save', ['id' => $post->id ?? 0]) }}">
                    @csrf
                    <button id="left">SAVE</button>
                </form>
                <form method="GET" action="{{ route('post.index') }}">
                    <button id="right">NEXT</button>
                </form>
            </div>
            <a href="{{ route('post.edit', ['id' => $post->id ?? 0]) }}">
                <button id="down">EDIT</button>
            </a>
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
