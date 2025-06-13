<!-- resources/views/profile/edit.blade.php -->
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="/css/profile.css">
</head>
<body>
    <div class="container">
        <div class="card">
            <h1 class="title">PROFILE</h1>
            <div class="avatar-container">
                <img src="/images/avatar_sample.png" alt="Avatar" class="avatar">
                <button class="image-edit">IMAGE EDIT</button>
            </div>
            <form class="form">
                <label class="label">NAME</label>
                <input type="text" class="input" value="既存ネーム">

                <label class="label">ADDRESS</label>
                <input type="email" class="input" value="既存メールアドレス">

                <label class="label">PASSWORD</label>
                <input type="password" class="input" value="password">

                <label class="label">REPASS</label>
                <input type="password" class="input" value="password">

                <button type="submit" class="update-button">UPDATE</button>
            </form>
        </div>
    </div>
</body>
</html>
