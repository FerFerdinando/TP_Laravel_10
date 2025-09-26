<!DOCTYPE html>
<html data-bs-theme="dark">
<head>
    <title>🐸 Edit Frog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    @include('frog.styles')
</head>
<body>
    <div class="container mt-4">
        <h1 class="mb-4">🐸 Edit Frog</h1>
        
        <a href="{{ route('frog.index') }}" class="btn btn-back mb-4">← Back to List</a>
        
            <form method="POST" action="{{ route('frog.update', $frog->id) }}" class="bg-dark p-4 rounded" enctype="multipart/form-data">
                @csrf
                @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $frog->name) }}" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="picture" class="form-label">Picture (optional):</label>
                    @if($frog->picture)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $frog->picture) }}" alt="Current Picture" class="rounded" style="width: 100px; height: 100px; object-fit: cover;">
                        </div>
                    @endif
                    <input type="file" class="form-control" id="picture" name="picture" accept="image/*">
                    <small class="text-muted">Max 2MB. Supported formats: JPEG, PNG, JPG, GIF</small>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="color" class="form-label">Color:</label>
                    <input type="text" class="form-control" id="color" name="color" value="{{ old('color', $frog->color) }}" required>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="age" class="form-label">Age:</label>
                    <input type="number" class="form-control" id="age" name="age" value="{{ old('age', $frog->age) }}" min="0" required>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="habitat" class="form-label">Habitat:</label>
                    <input type="text" class="form-control" id="habitat" name="habitat" value="{{ old('habitat', $frog->habitat) }}" required>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="is_poisonous" class="form-label">Poisonous:</label>
                    <select class="form-select" id="is_poisonous" name="is_poisonous" required>
                        <option value="0" {{ old('is_poisonous', $frog->is_poisonous) == 0 ? 'selected' : '' }}>No</option>
                        <option value="1" {{ old('is_poisonous', $frog->is_poisonous) == 1 ? 'selected' : '' }}>Yes</option>
                    </select>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="weight" class="form-label">Weight (kg):</label>
                    <input type="number" class="form-control" id="weight" name="weight" value="{{ old('weight', $frog->weight) }}" step="0.01" min="0" required>
                </div>
                
                <div class="col-12 mb-3">
                    <label for="description" class="form-label">Description:</label>
                    <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description', $frog->description) }}</textarea>
                </div>
                
                <div class="col-12">
                    <button type="submit" class="btn btn-frog">Update Frog</button>
                </div>
            </div>
        </form>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
