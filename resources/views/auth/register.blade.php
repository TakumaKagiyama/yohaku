<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>
<body>
    <div class="register-background">
        <div class="register-box">
            <h2>CREATE ACCOUNT</h2>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <input type="text" name="name" placeholder="NAME" value="{{ old('name') }}" required>
                @error('name')
                    <div class="error">{{ $message }}</div>
                @enderror

                <!-- Email -->
                <input type="email" name="email" placeholder="ADDRESS" value="{{ old('email') }}" required>
                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror

                <!-- Password -->
                <input type="password" name="password" placeholder="PASSWORD" required>
                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror

                <!-- Confirm Password -->
                <input type="password" name="password_confirmation" placeholder="REPASS" required>
                @error('password_confirmation')
                    <div class="error">{{ $message }}</div>
                @enderror

                <button type="submit">LOGIN</button>
            </form>
        </div>
    </div>
</body>
</html>
