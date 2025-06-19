<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>プロフィール編集</title>
    <link rel="stylesheet" href="{{ asset('css/profile_edit.css') }}">
</head>
<body>
    <div class="profile-background">
        <div class="profile-box">
            <h2>PROFILE EDIT</h2>

            <!-- エラーメッセージ表示 -->
@if ($errors->any())
    <div class="error-messages">
        <ul>
            @foreach ($errors->all() as $error)
                <li style="color: red; font-size: 14px;">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- 成功メッセージ表示 -->
@if (session('status'))
    <div class="success-message" style="color: green; font-size: 14px;">
        {{ session('status') }}
    </div>
@endif

            <!-- プロフィール画像 -->
            <div class="profile-image-wrapper">
            <img src="{{ Auth::user()->profile_image ? asset('storage/' . Auth::user()->profile_image) : asset('images/default_icon.png') }}" alt="プロフィール画像" class="profile-image">

                <form action="{{ route('profile.image.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label for="profile_image" class="image-edit-button">IMAGE EDIT</label>
                    <input type="file" id="profile_image" name="profile_image" style="display: none;" onchange="this.form.submit()">
                </form>
            </div>

            <!-- 編集フォーム -->
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT')
                <input type="text" name="name" placeholder="名前" value="{{ old('name', Auth::user()->name ?? '') }}" required>
                <input type="email" name="email" placeholder="メールアドレス" value="{{ old('email', Auth::user()->email ?? '') }}" required>
                <input type="password" name="password" placeholder="新しいパスワード（任意）">
                <input type="password" name="password_confirmation" placeholder="確認用パスワード">
                <button type="submit">UPDATE</button>
            </form>
        </div>
    </div>
</body>
</html>
