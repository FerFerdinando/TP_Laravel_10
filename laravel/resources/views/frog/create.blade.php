<!DOCTYPE html>
<html>
<head>
    <title>Add New Frog</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; }
        input, select, textarea { padding: 8px; width: 300px; }
        .back-btn { margin-bottom: 20px; padding: 10px; background: #ff0000ff; color: black; text-decoration: none; }
        .submit-btn { padding: 10px; background: #d10ed1ff; color: white; border: none; cursor: pointer; }
    </style>
</head>
<body>
    <h1>Add New Frog</h1>
    
    <form method="POST" action="{{ route('frog.store') }}">
        @csrf
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        
        <div class="form-group">
            <label for="color">Color:</label>
            <input type="text" id="color" name="color" required>
        </div>
        
        <div class="form-group">
            <label for="age">Age:</label>
            <input type="number" id="age" name="age" min="0" required>
        </div>
        
        <div class="form-group">
            <label for="habitat">Habitat:</label>
            <input type="text" id="habitat" name="habitat" required>
        </div>
        
        <div class="form-group">
            <label for="is_poisonous">Poisonous:</label>
            <select id="is_poisonous" name="is_poisonous" required>
                <option value="0">No</option>
                <option value="1">Yes</option>
            </select>
        </div>
        
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="3" required></textarea>
        </div>
        
        <div class="form-group">
            <label for="weight">Weight (kg):</label>
            <input type="number" id="weight" name="weight" step="0.01" min="0" required>
        </div>
        
        <button type="submit" class="submit-btn">Add Frog</button>
    </form>

    <br>
    <a href="{{ route('frog.index') }}" class="back-btn">Back to List</a>
</body>
</html>
