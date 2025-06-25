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
                    <img src="{{ asset('storage/' . $post->image) }}" alt="投稿画像" class="post-image">
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

        {{-- 🔻 投稿の有無に関わらず常に表示されるコントローラー --}}
        <div class="controller-grid">
            <a href="/mypage/my_journal">
                <button id="up" class="controller-btn">MYPAGE</button>
            </a>

            <div class="middle-row">
                <form method="POST" action="{{ route('post.save', ['id' => $post->id ?? 0]) }}">
                    @csrf
                    <button id="left" class="controller-btn">SAVE</button>
                </form>

                <form method="GET" action="{{ route('post.index') }}">
                    <input type="hidden" name="current" value="{{ $post->id ?? '' }}">
                    <button id="right" class="controller-btn">NEXT</button>
                </form>



            </div>

            <a href="{{ route('post.edit', ['post' => $post->id ?? 0]) }}">
                <button id="down" class="controller-btn">EDIT</button>
            </a>
        </div>

        {{-- ハンバーガーメニュー --}}
        <div class="hamburger-menu" id="menu-toggle">
            <div></div>
            <div></div>
            <div></div>
        </div>

        <div class="genre-menu" id="genre-menu">
            <ul>
                @foreach ($genres as $genre)
                    <li class="genre-item">
                        <a href="{{ route('post.genre', ['genre_id' => $genre->id]) }}">{{ $genre->name }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <script src="{{ asset('js/post.js') }}"></script>
</body>

</html>
