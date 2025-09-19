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
        
        <div class="d-flex gap-2 mb-4">
            <a href="{{ route('frog.create') }}" class="btn btn-frog">Add New Frog</a>
            <button type="button" class="btn btn-lavender" id="editModeBtn">Edit Frog</button>
            <button type="button" class="btn btn-danger" id="deleteModeBtn">Delete Frog</button>
            <form action="{{ route('frog.restoreAll') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-teal" onclick="return confirm('Restore all deleted frogs?')">Restore All Deleted</button>
            </form>
        </div>
        
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
                <tr data-frog-id="{{ $frog->id }}" class="frog-row">
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
    </div>
    
    <form id="editForm" action="" method="GET" style="display: none;">
        @csrf
    </form>
    
    <form id="deleteForm" action="" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editModeBtn = document.getElementById('editModeBtn');
            const deleteModeBtn = document.getElementById('deleteModeBtn');
            const frogRows = document.querySelectorAll('.frog-row');
            const editForm = document.getElementById('editForm');
            const deleteForm = document.getElementById('deleteForm');
            
            let editMode = false;
            let deleteMode = false;
            
            // Add hover effect to all rows
            frogRows.forEach(row => {
                row.addEventListener('mouseenter', function() {
                    this.style.backgroundColor = 'var(--ctp-mocha-surface1)';
                    this.style.cursor = 'pointer';
                });
                
                row.addEventListener('mouseleave', function() {
                    this.style.backgroundColor = '';
                    this.style.cursor = '';
                });
            });
            
            // Edit mode
            editModeBtn.addEventListener('click', function() {
                editMode = !editMode;
                deleteMode = false;
                deleteModeBtn.classList.remove('active');
                
                if (editMode) {
                    this.classList.add('active');
                    frogRows.forEach(row => {
                        row.addEventListener('click', handleEditClick);
                    });
                } else {
                    this.classList.remove('active');
                    frogRows.forEach(row => {
                        row.removeEventListener('click', handleEditClick);
                    });
                }
            });
            
            // Delete mode
            deleteModeBtn.addEventListener('click', function() {
                deleteMode = !deleteMode;
                editMode = false;
                editModeBtn.classList.remove('active');
                
                if (deleteMode) {
                    this.classList.add('active');
                    frogRows.forEach(row => {
                        row.addEventListener('click', handleDeleteClick);
                    });
                } else {
                    this.classList.remove('active');
                    frogRows.forEach(row => {
                        row.removeEventListener('click', handleDeleteClick);
                    });
                }
            });
            
            function handleEditClick(e) {
                const frogId = this.getAttribute('data-frog-id');
                if (confirm('Edit this frog?')) {
                    editForm.action = `/frogs/${frogId}/edit`;
                    editForm.submit();
                }
            }
            
            function handleDeleteClick(e) {
                const frogId = this.getAttribute('data-frog-id');
                if (confirm('Are you sure you want to delete this frog?')) {
                    deleteForm.action = `/frogs/${frogId}`;
                    deleteForm.submit();
                }
            }
        });
    </script>
</body>
</html>
