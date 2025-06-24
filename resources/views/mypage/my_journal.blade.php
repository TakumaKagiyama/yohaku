<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- ← これが重要！ -->
    <title>マイジャーナル</title>
    <link rel="stylesheet" href="{{ asset('css/my_journal.css') }}">
</head>

<body>
    <div class="profile-background">
        <div class="top-buttons">
            <a href="javascript:void(0);" onclick="showLogoutModal()">LOGOUT</a>
        </div>

        <div class="profile-container">
            <img class="profile-image"
                src="{{ Auth::user()->profile_image ? asset('storage/' . Auth::user()->profile_image) : asset('images/default_icon.png') }}"
                alt="プロフィール画像">

            <h2 class="username">{{ Auth::user()->name }}さん</h2>

            <div class="action-buttons">
                <a href="{{ route('mypage.profile_edit') }}" class="edit-button">EDIT</a>
                <a href="{{ route('post.index') }}" class="edit-button">HOME</a>
            </div>
        </div>



        <div class="post-section">
            {{-- <div class="post-tabs">
                <h3>POSTS</h3>
                <h3>SAVE</h3>
            </div> --}}

            <div class="post-tabs">
                <h3 class="active" onclick="showTab('post')">POSTS</h3>
                <h3 onclick="showTab('save')">SAVE</h3>
            </div>

            {{-- 投稿がある場合 --}}
            {{-- @if ($posts->isNotEmpty())
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
            {{-- <p class="no-post">まだ投稿がありません。</p>
            @endif --}}

            {{-- 保存済み一覧
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
            @endif --}}

            @if ($posts->isNotEmpty())
                <div class="post-grid" id="postList">
                    @foreach ($posts as $post)
                        <div class="post-card"
                            onclick="showModal(
                    '{{ asset('storage/' . $post->image) }}',
                    '{{ addslashes($post->content) }}',
                    '{{ $post->genre->name ?? 'ジャンルなし' }}'
                )">
                            <div class="image-box">
                                <img src="{{ asset('storage/' . $post->image) }}" alt="投稿画像">
                            </div>
                            <div class="content-box">
                                <p class="content-text">{{ $post->content }}</p>
                                <p class="genre-tag">#{{ $post->genre->name ?? 'ジャンルなし' }}</p>
                            </div>
                            <div class="post-buttons">
                                <a href="{{ route('post.edit', $post->id) }}" class="post-edit-button">EDIT</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div id="postList">
                    <p class="no-post">まだ投稿がありません。</p>
                </div>
            @endif


            {{-- 保存済み一覧 --}}
            @if ($savedPosts->isNotEmpty())
                <div class="post-grid" id="savedList" style="display: none;">
                    @foreach ($savedPosts as $post)
                        <div class="post-card"
                            onclick="showModal(
            '{{ asset('storage/' . $post->image) }}',
            '{{ addslashes($post->content) }}',
            '{{ $post->genre->name ?? 'ジャンルなし' }}'
        )">
                            <div class="image-box">
                                <img src="{{ asset('storage/' . $post->image) }}" alt="保存済み画像">
                            </div>
                            <div class="content-box">
                                <p class="content-text">{{ $post->content }}</p>
                                <p class="genre-tag">#{{ $post->genre->name ?? 'ジャンルなし' }}</p>
                            </div>
                            <form method="POST" action="{{ route('post.unsave', $post->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="unsave-btn"
                                    onclick="event.stopPropagation();">保存解除</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            @else
                <div id="savedList" style="display: none;">
                    <p class="no-post">まだ保存された投稿がありません。</p>
                </div>
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

    <!-- 投稿詳細モーダル -->
    <div id="postModal" class="modal" style="display: none;">
        <div class="modal-content">
            <span class="modal-close" onclick="closeModal()">&times;</span>
            <img id="modalImage" src="" alt="詳細画像">
            <p id="modalContent" class="modal-text"></p>
            <p id="modalGenre" class="modal-genre"></p>
        </div>
    </div>

</body>

<script>
    function showTab(tab) {
        const postList = document.getElementById('postList');
        const savedList = document.getElementById('savedList');
        const tabs = document.querySelectorAll('.post-tabs h3');

        tabs.forEach(t => t.classList.remove('active'));

        if (tab === 'post') {
            postList.style.display = 'grid'; // ← block → grid に変更！
            savedList.style.display = 'none';
            tabs[0].classList.add('active');
        } else if (tab === 'save') {
            postList.style.display = 'none';
            savedList.style.display = 'grid';
            tabs[1].classList.add('active');
        }
    }

    // ✅ ページ読み込み時に初期タブを強制表示
    window.addEventListener('DOMContentLoaded', () => {
        showTab('post'); // ← 初期タブを確実に表示する
    });

    function showModal(imageSrc, content, genre) {
        document.getElementById('modalImage').src = imageSrc;
        document.getElementById('modalContent').innerText = content;
        document.getElementById('modalGenre').innerText = genre ? '#' + genre : '#ジャンルなし';
        document.getElementById('postModal').style.display = 'flex';
    }

    function closeModal() {
        document.getElementById('postModal').style.display = 'none';
    }

    // 背景クリックで閉じる処理
    window.addEventListener('click', function(event) {
        const modal = document.getElementById('postModal');
        const modalContent = document.querySelector('.modal-content');
        if (event.target === modal) {
            closeModal();
        }
    });
</script>

</html>
