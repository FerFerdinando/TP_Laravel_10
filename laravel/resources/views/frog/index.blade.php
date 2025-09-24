<!DOCTYPE html>
<html data-bs-theme="dark">
<head>
    <title>🐸 Frog List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    @include('frog.styles')
</head>
<body>
    @if (Auth::check())
        <div class="position-fixed top-0 end-0 p-3 z-3">
            <div class="d-flex align-items-center gap-2">
                <span class="text-light small">Hi {{ explode(' ', Auth::user()->name)[0] }} 🐸 !</span>
                <button type="button" class="btn btn-secondary btn-sm" id="logoutBtn">Logout</button>
            </div>
        </div>
    @else
        <div class="position-fixed top-0 end-0 p-3 z-3">
            <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
        </div>
    @endif

    <div class="container mt-4 pt-5"> <!-- Add pt-5 to account for fixed top -->
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
                <tr data-frog-id="{{ $frog->id }}" class="frog-row" data-description="{{ $frog->description }}">
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
        
        @if (Auth::check())
            <div class="d-flex gap-2 mt-4">
                <a href="{{ route('frog.create') }}" class="btn btn-success">Add Frog</a>
                <button type="button" class="btn btn-lavender" id="editModeBtn">Edit Frog</button>
                <button type="button" class="btn btn-danger" id="deleteModeBtn">Delete Frog</button>
                <button type="button" class="btn btn-info" id="restoreBtn">Restore All</button>
            </div>
        @endif
    </div>
    
    <!-- Generic Confirmation Modal -->
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-dark border-0">
                <div class="modal-header border-0">
                    <h5 class="modal-title text-light" id="confirmModalLabel">Confirm Action</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-light" id="confirmModalBody">
                    Are you sure?
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="confirmAction">Confirm</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal (specific for delete) -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-dark border-0">
                <div class="modal-header border-0">
                    <h5 class="modal-title text-light" id="deleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-light">
                    Are you sure you want to delete this frog? This action cannot be undone.
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
                </div>
            </div>
        </div>
    </div>
    
    <form id="editForm" action="" method="GET" style="display: none;">
        @csrf
    </form>
    
    <form id="deleteForm" action="" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    <form id="logoutForm" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <form id="restoreForm" action="{{ route('frog.restoreAll') }}" method="POST" style="display: none;">
        @csrf
    </form>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editModeBtn = document.getElementById('editModeBtn');
            const deleteModeBtn = document.getElementById('deleteModeBtn');
            const frogRows = document.querySelectorAll('.frog-row');
            const editForm = document.getElementById('editForm');
            const deleteForm = document.getElementById('deleteForm');
            const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
            const confirmDeleteBtn = document.getElementById('confirmDelete');
            const confirmModal = new bootstrap.Modal(document.getElementById('confirmModal'));
            const confirmActionBtn = document.getElementById('confirmAction');
            const logoutBtn = document.getElementById('logoutBtn');
            const restoreBtn = document.getElementById('restoreBtn');
            let selectedFrogId = null;
            let editMode = false;
            let deleteMode = false;
            let hoverTimeout = null;
            let tooltip = null;
            let pendingAction = null;
            let pendingForm = null;
            let pendingMessage = '';
            let pendingTitle = '';
            
            if (!editModeBtn) return; // If not logged in, skip
            
            // Create tooltip element
            tooltip = document.createElement('div');
            tooltip.className = 'frog-tooltip';
            tooltip.style.display = 'none';
            document.body.appendChild(tooltip);
            
            // Hover effect with tooltip after 1.5s
            frogRows.forEach(row => {
                row.addEventListener('mouseenter', function() {
                    this.style.backgroundColor = 'var(--ctp-mocha-surface1)';
                    this.style.cursor = 'pointer';
                    
                    const description = this.getAttribute('data-description');
                    if (description) {
                        hoverTimeout = setTimeout(() => {
                            tooltip.textContent = description;
                            const rect = this.getBoundingClientRect();
                            tooltip.style.left = (rect.left + window.scrollX) + 'px';
                            tooltip.style.top = (rect.bottom + window.scrollY + 5) + 'px';
                            tooltip.style.display = 'block';
                        }, 1500);
                    }
                });
                
                row.addEventListener('mouseleave', function() {
                    this.style.backgroundColor = '';
                    this.style.cursor = '';
                    clearTimeout(hoverTimeout);
                    tooltip.style.display = 'none';
                });
            });
            
            // Edit mode - no confirmation
            editModeBtn.addEventListener('click', function() {
                if (deleteMode) {
                    deleteMode = false;
                    deleteModeBtn.classList.remove('btn-active');
                    frogRows.forEach(row => row.removeEventListener('click', handleDeleteClick));
                }
                editMode = !editMode;
                if (editMode) {
                    this.classList.add('btn-active');
                    frogRows.forEach(row => row.addEventListener('click', handleEditClick));
                } else {
                    this.classList.remove('btn-active');
                    frogRows.forEach(row => row.removeEventListener('click', handleEditClick));
                }
            });
            
            // Delete mode - custom modal
            deleteModeBtn.addEventListener('click', function() {
                if (editMode) {
                    editMode = false;
                    editModeBtn.classList.remove('btn-active');
                    frogRows.forEach(row => row.removeEventListener('click', handleEditClick));
                }
                deleteMode = !deleteMode;
                if (deleteMode) {
                    this.classList.add('btn-active');
                    frogRows.forEach(row => row.addEventListener('click', handleDeleteClick));
                } else {
                    this.classList.remove('btn-active');
                    frogRows.forEach(row => row.removeEventListener('click', handleDeleteClick));
                }
            });
            
            function handleEditClick(e) {
                const frogId = this.getAttribute('data-frog-id');
                editForm.action = `/${frogId}/edit`;
                editForm.submit();
            }
            
            function handleDeleteClick(e) {
                selectedFrogId = this.getAttribute('data-frog-id');
                deleteModal.show();
            }
            
            // Confirm delete (specific)
            confirmDeleteBtn.addEventListener('click', function() {
                deleteForm.action = `/${selectedFrogId}`;
                deleteForm.submit();
                deleteModal.hide();
            });

            // Generic confirm action
            confirmActionBtn.addEventListener('click', function() {
                if (pendingForm && pendingAction) {
                    if (pendingAction === 'logout') {
                        logoutForm.submit();
                    } else if (pendingAction === 'restore') {
                        restoreForm.submit();
                    }
                }
                confirmModal.hide();
            });

            // Logout button
            if (logoutBtn) {
                logoutBtn.addEventListener('click', function() {
                    pendingAction = 'logout';
                    pendingForm = logoutForm;
                    pendingMessage = 'Are you sure you want to logout?';
                    pendingTitle = 'Confirm Logout';
                    document.getElementById('confirmModalBody').textContent = pendingMessage;
                    document.getElementById('confirmModalLabel').textContent = pendingTitle;
                    confirmModal.show();
                });
            }

            // Restore button
            if (restoreBtn) {
                restoreBtn.addEventListener('click', function() {
                    pendingAction = 'restore';
                    pendingForm = restoreForm;
                    pendingMessage = 'Restore all deleted frogs?';
                    pendingTitle = 'Confirm Restore';
                    document.getElementById('confirmModalBody').textContent = pendingMessage;
                    document.getElementById('confirmModalLabel').textContent = pendingTitle;
                    confirmModal.show();
                });
            }
            
            // Escape key to deactivate modes
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    if (editMode) {
                        editMode = false;
                        editModeBtn.classList.remove('btn-active');
                        frogRows.forEach(row => row.removeEventListener('click', handleEditClick));
                    }
                    if (deleteMode) {
                        deleteMode = false;
                        deleteModeBtn.classList.remove('btn-active');
                        frogRows.forEach(row => row.removeEventListener('click', handleDeleteClick));
                    }
                    deleteModal.hide();
                }
            });
        });
    </script>
</body>
</html>
