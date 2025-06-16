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
            <p class="user-comment">チャンスの神様は前頭しかない 🐣</p>

            <div class="action-buttons">
                {{-- <a href="#" class="edit-button">EDIT</a> --}}
                <a href="{{ route('mypage.profile_edit') }}" class="edit-button">EDIT</a>
                <a href="{{ route('home') }}" class="home-button">HOME</a>
            </div>
        </div>

        <div class="post-section">
            <div class="post-tabs">
                <h3>POSTS</h3>
                <h3>SAVE</h3>
            </div>

            <div class="posts">
                <div class="post-item"><img src="{{ asset('images/sample-post.jpg') }}" alt="投稿1"></div>
                <div class="post-item"><img src="{{ asset('images/sample-post.jpg') }}" alt="投稿2"></div>
            </div>

            <div class="saved">
                <div class="post-item"><img src="{{ asset('images/sample-post.jpg') }}" alt="保存1"></div>
                <div class="post-item"><img src="{{ asset('images/sample-post.jpg') }}" alt="保存2"></div>
            </div>
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
