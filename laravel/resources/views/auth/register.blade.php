<!DOCTYPE html>
<html data-bs-theme="dark">
<head>
    <title>🐸 Make Froggy Cred!</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #1e1e2e;
            color: #cdd6f4;
            font-family: Arial, sans-serif;
        }
        .login-box {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 400px;
            padding: 40px;
            background-color: #313244;
            border: 1px solid #585b70;
            border-radius: 0;
        }
        .form-control {
            background-color: #45475a;
            color: #cdd6f4;
            border: 1px solid #585b70;
            border-radius: 0;
        }
        .form-control:focus {
            background-color: #45475a;
            color: #cdd6f4;
            border-color: #89b4fa;
            box-shadow: none;
        }
        .btn-primary {
            background-color: #a6e3a1;
            color: #1e1e2e;
            border: none;
            border-radius: 0;
            width: 100%;
        }
        .btn-primary:hover {
            background-color: #94e2d5;
            color: #1e1e2e;
        }
        .btn-secondary {
            background-color: #45475a;
            color: #cdd6f4;
            border: 1px solid #585b70;
            border-radius: 0;
            width: 100%;
        }
        .btn-secondary:hover {
            background-color: #585b70;
            color: #cdd6f4;
        }
        .frog-emoji {
            font-size: 4rem;
            text-align: center;
            margin-bottom: 20px;
        }
        .login-title {
            text-align: center;
            margin-bottom: 30px;
            color: #cdd6f4;
        }
        .form-label {
            color: #cdd6f4;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <div class="frog-emoji">🐸</div>
        <h2 class="login-title">Make Froggy Cred!</h2>
        
        <form method="POST" action="{{ route('register') }}">
            @csrf
            
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required minlength="8">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
                @error('password_confirmation')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary mb-2">Register</button>
                <a href="{{ route('login') }}" class="btn btn-secondary">Return</a>
            </div>
        </form>
    </div>
</body>
</html>
