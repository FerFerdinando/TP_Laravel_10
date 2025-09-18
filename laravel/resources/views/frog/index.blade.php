<!DOCTYPE html>
<html data-bs-theme="dark">
<head>
    <title>🐸 Frog List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    @include('frog.styles')
</head>
<body>
    <div class="container mt-4">
        <h1 class="mb-4">🐸 Frog List</h1>
        
        
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Color</th>
                    <th>Age</th>
                    <th>Habitat</th>
                    <th>Poisonous</th>
                    <th>Weight (kg)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($frogs as $frog)
                <tr>
                    <td>{{ $frog->id }}</td>
                    <td>{{ $frog->name }}</td>
                    <td>{{ $frog->color }}</td>
                    <td>{{ $frog->age }}</td>
                    <td>{{ $frog->habitat }}</td>
                    <td>{{ $frog->is_poisonous ? 'Yes' : 'No' }}</td>
                    <td>{{ $frog->weight }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('frog.create') }}" class="btn btn-frog mb-4">Add New Frog</a>
    </div>

    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
