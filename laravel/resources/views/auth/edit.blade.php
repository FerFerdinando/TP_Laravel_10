<!DOCTYPE html>
<html data-bs-theme="dark">
<head>
    <title>🐸 Edit Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    @include('frog.styles')
</head>
<body>
    <div class="login-box">
        <div class="frog-emoji">🐸</div>
        <h2 class="login-title">Edit Profile</h2>
        
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $user->name) }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="current_password" class="form-label">Current Password (required for password change)</label>
                <input id="current_password" type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password">
                @error('current_password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="new_password" class="form-label">New Password (optional)</label>
                <input id="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password">
                @error('new_password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                <input id="new_password_confirmation" type="password" class="form-control" name="new_password_confirmation">
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary mb-2 w-100">Update Profile</button>
                <a href="{{ route('frog.index') }}" class="btn btn-secondary w-100">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>
