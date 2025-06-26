<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>投稿一覧</title>
    <link rel="stylesheet" href="{{ asset('css/post.css') }}">
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
        {{-- <div class="controller-grid">
            <a href="/mypage/my_journal">
                <button id="up" class="controller-btn">MYPAGE</button>
            </a>

            <div class="middle-row">
                <form method="POST" action="{{ route('post.save', ['id' => $post->id ?? 0]) }}">
                {{-- <form method="POST" action="{{ route('post.save', ['id' => $post->id ?? 0]) }}">
                    @csrf
                    <button id="left" class="controller-btn">SAVE</button>
                </form> --}}
                {{-- @if ($post)
                <form method="POST" action="{{ route('post.save', ['id' => $post->id]) }}">
                @csrf
                <button id="left" class="controller-btn">SAVE</button>
                </form>
                @else
                <button id="left" class="controller-btn" disabled style="opacity: 0.5; cursor: not-allowed;">
                SAVE
                </button>
                @endif

                <form method="GET" action="{{ route('post.index') }}">
                    <input type="hidden" name="current" value="{{ $post->id ?? '' }}">
                    <button id="right" class="controller-btn">NEXT</button>
                </form>

            </div>

            <a href="{{ route('post.edit', ['post' => $post->id ?? 0]) }}">
            @if ($post)
                <a href="{{ route('post.edit', ['post' => $post->id]) }}">
                <button id="down" class="controller-btn">EDIT</button>
            </a>
        </div>
                </a>
                @else
                <button id="down" class="controller-btn" disabled style="opacity: 0.5; cursor: not-allowed;">
                EDIT
                </button>
                @endif
            </div> --}} 

            <div class="controller-grid">

                {{-- MYPAGE ボタン（<a> のみ使用） --}}
                    <form method="GET" action="/mypage/my_journal">
                        <button id="up" class="controller-btn">MYPAGE</button>
                    </form>
            
                <div class="middle-row">
                    {{-- SAVE ボタン --}}
                    @if ($post)
                        <form method="POST" action="{{ route('post.save', ['id' => $post->id]) }}">
                            @csrf
                            <button id="left" class="controller-btn">SAVE</button>
                        </form>
                    @else
                        <button id="left" class="controller-btn" disabled style="opacity: 0.5; cursor: not-allowed;">
                            SAVE
                        </button>
                    @endif
            
                    {{-- NEXT ボタン --}}
                    @if ($post)
                        <form method="GET" action="{{ route('post.index') }}">
                            <input type="hidden" name="current" value="{{ $post->id }}">
                            <button id="right" class="controller-btn">NEXT</button>
                        </form>
                    @else
                        <button id="right" class="controller-btn" disabled style="opacity: 0.5; cursor: not-allowed;">
                            NEXT
                        </button>
                    @endif
                </div>
            
                {{-- EDIT ボタン --}}
                @if ($post)
                <form method="GET" action="{{ route('post.edit', ['post' => $post->id]) }}">
                <button id="down" class="controller-btn">EDIT</button>
                </form>
                @else
                <button id="down" class="controller-btn" disabled style="opacity: 0.5; cursor: not-allowed;">
                EDIT
                </button>
                @endif
            </div>            

    <input type="checkbox" id="menu-switch" hidden>
    <label for="menu-switch">

        {{-- ハンバーガーメニュー --}}

        <div class="hamburger-menu" id="menu-toggle">
            <div class="bar top-bar"></div>
            <div class="bar middle-bar"></div>
            <div class="bar bottom-bar"></div>
        </div>
        </label>

        <div class="genre-menu" id="genre-menu">
            <ul>
                @foreach ($genres as $genre)
                    <li class="genre-item">
                        <a href="{{ route('post.genre', ['genre_id' => $genre->id]) }}">{{ $genre->name }}</a>
                    </li>

                @endforeach
            </ul>


                
            </div>
            <style>
    </style>

        </div>

    <script src="{{ asset('js/post.js') }}"></script>

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

    <script>
        window.addEventListener('DOMContentLoaded', function () {
        const saveButton = document.getElementById('left');
        if (saveButton && saveButton.disabled) {
        saveButton.addEventListener('click', function (e) {
            e.preventDefault(); // 念のため送信させない
        });
        }
        });
    </script>

</body>

</html>
