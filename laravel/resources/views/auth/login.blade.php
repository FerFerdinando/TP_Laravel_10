<!DOCTYPE html>
<html data-bs-theme="dark">
<head>
    <title>🐸 Enter Froggy Cred!</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    @include('frog.styles')
</head>
<body>
    <div class="login-box">
        <div class="frog-emoji">🐸</div>
        <h2 class="login-title">Enter Froggy Cred!</h2>
        
        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary mb-2 w-100">Login</button>
                <a href="{{ route('register') }}" class="btn btn-secondary w-100">Register</a>
            </div>
        </form>
    </div>
</body>
</html>
