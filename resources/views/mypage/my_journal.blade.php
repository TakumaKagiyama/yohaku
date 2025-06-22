<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>マイジャーナル</title>
    <link rel="stylesheet" href="{{ asset('css/my_journal.css') }}">
</head>

<body>
    <div class="profile-background">
        <div class="top-buttons">
            <a href="{{ route('login') }}">LOGIN</a>
            <a href="javascript:void(0);" onclick="showLogoutModal()">LOGOUT</a>
        </div>

        <div class="profile-container">
            <img class="profile-image" src="{{ asset('images/sample-user.png') }}" alt="プロフィール画像">
            <h2 class="username">誠一郎くん</h2>
            <p class="user-comment">チャンスの神様は前頭しかない 🐣
                俺がそう思ったからそう思った
            </p>

            <div class="action-buttons">
                {{-- <a href="#" class="edit-button">EDIT</a> --}}
                <a href="{{ route('mypage.profile_edit') }}" class="edit-button">EDIT</a>
                {{-- <a href="{{ route('home') }}" class="home-button">HOME</a> --}}
            </div>
        </div>

        <div class="post-section">
            <div class="post-tabs">
                <h3>POSTS</h3>
                <h3>SAVE</h3>
            </div>

            {{-- 投稿がある場合 --}}
            @if ($posts->isNotEmpty())
                <div class="post-grid">
                    @foreach ($posts as $post)
                        <div class="post-card">
                            <div class="image-box">
                                <img src="{{ asset('storage/' . $post->image) }}" alt="投稿画像">
                            </div>
                            <div class="content-box">
                                <p class="content-text">{{ $post->content }}</p>
                                <p class="genre-tag">#{{ $post->genre->name ?? 'ジャンルなし' }}</p>
                            </div>
                            <div class="post-buttons">
                                <a href="{{ route('post.edit', $post->id) }}" class="post-edit-button">編集する</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                {{-- 投稿がないときの表示 --}}
                <p class="no-post">まだ投稿がありません。</p>
            @endif

            {{-- 保存済み一覧--}}
            @if ($savedPosts->isNotEmpty())
                <div class="post-grid">
                    @foreach ($savedPosts as $post)
                        <div class="post-card">
                            <div class="image-box">
                                <img src="{{ asset('storage/' . $post->image) }}" alt="保存済み画像">
                            </div>
                            <div class="content-box">
                                <p class="content-text">{{ $post->content }}</p>
                                <p class="genre-tag">#{{ $post->genre->name ?? 'ジャンルなし' }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="no-post">まだ保存された投稿がありません。</p>
            @endif

        </div>
    </div>

    <!-- ログアウト確認モーダル -->
    <div id="logoutModal" class="logout-modal" style="display: none;">
        <p>本当にログアウトしますか？</p>
        <div class="modal-buttons">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="confirm">はい</button>
            </form>
            <button class="cancel" onclick="hideLogoutModal()">いいえ</button>
        </div>
    </div>

    <!-- JavaScriptでモーダル制御 -->
    <script>
        function showLogoutModal() {
            document.getElementById('logoutModal').style.display = 'block';
        }

        function hideLogoutModal() {
            document.getElementById('logoutModal').style.display = 'none';
        }
    </script>

</body>

</html>
