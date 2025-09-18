<!DOCTYPE html>
<html data-bs-theme="dark">
<head>
    <title>🐸 Add New Frog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    @include('frog.styles')
</head>
<body>
    <div class="container mt-4">
        <h1 class="mb-4">🐸 Add New Frog</h1>
        
        <a href="{{ route('frog.index') }}" class="btn btn-back mb-4">← Back to List</a>
        
        <form method="POST" action="{{ route('frog.store') }}" class="bg-dark p-4 rounded">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="color" class="form-label">Color:</label>
                    <input type="text" class="form-control" id="color" name="color" required>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="age" class="form-label">Age:</label>
                    <input type="number" class="form-control" id="age" name="age" min="0" required>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="habitat" class="form-label">Habitat:</label>
                    <input type="text" class="form-control" id="habitat" name="habitat" required>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="is_poisonous" class="form-label">Poisonous:</label>
                    <select class="form-select" id="is_poisonous" name="is_poisonous" required>
                        <option value="0">No</option>
                        <option value="1">Yes</option>
                    </select>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="weight" class="form-label">Weight (kg):</label>
                    <input type="number" class="form-control" id="weight" name="weight" step="0.01" min="0" required>
                </div>
                
                <div class="col-12 mb-3">
                    <label for="description" class="form-label">Description:</label>
                    <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                </div>
                
                <div class="col-12">
                    <button type="submit" class="btn btn-frog">Add Frog</button>
                </div>
            </div>
        </form>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
