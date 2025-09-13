<!DOCTYPE html>
<html>
<head>
    <title>Frog List</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .add-btn { margin-bottom: 20px; padding: 10px; background: #d10ed1ff; color: white; text-decoration: none; }
    </style>
</head>
<body>
    <h1>Frog List</h1>
    
    
    
    <table>
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
    <br>
    <a href="{{ route('frog.create') }}" class="add-btn">Add New Frog</a>
</body>
</html>
