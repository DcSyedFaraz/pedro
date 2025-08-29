@extends(Auth::user()->hasRole('Admin') ? 'admin.layouts.app' : 'manager.layouts.app')

@section('title', 'Users Management')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Users Management</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Users</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h3 class="card-title">User Management</h3>
                                    <a class="btn btn-success" href="{{ route('users.create') }}" role="button">
                                        <i class="fas fa-plus"></i> New User
                                    </a>
                                </div>
                            </div>

                            <div class="card-body">
                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif

                                @if (session('error'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ session('error') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif

                                <div class="table-responsive">
                                    <table id="users-table" class="table table-bordered table-striped"
                                        aria-label="Users list">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Roles</th>
                                                <th scope="col" class="text-center">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($data as $key => $user)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $user->name }}</td>
                                                    <td>
                                                        <a href="mailto:{{ $user->email }}"
                                                            aria-label="Send email to {{ $user->email }}">
                                                            {{ $user->email }}
                                                        </a>
                                                    </td>
                                                    <td>
                                                        @if ($user->roles->count() > 0)
                                                            @foreach ($user->roles as $role)
                                                                <span class="badge badge-success">{{ $role->name }}</span>
                                                            @endforeach
                                                        @else
                                                            <span class="badge badge-secondary">No Role</span>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="btn-group" role="group" aria-label="User actions">
                                                            <a class="btn btn-info btn-sm"
                                                                href="{{ route('users.show', $user->id) }}"
                                                                title="View user details"
                                                                aria-label="View details for {{ $user->name }}">
                                                                <i class="fas fa-eye"></i>
                                                            </a>

                                                            <a class="btn btn-primary btn-sm"
                                                                href="{{ route('users.edit', $user->id) }}"
                                                                title="Edit user" aria-label="Edit {{ $user->name }}">
                                                                <i class="fas fa-edit"></i>
                                                            </a>

                                                            @if ($user->id !== auth()->id())
                                                                <button type="button" class="btn btn-danger btn-sm"
                                                                    onclick="confirmDelete({{ $user->id }}, '{{ $user->name }}')"
                                                                    title="Delete user"
                                                                    aria-label="Delete {{ $user->name }}">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            @else
                                                                <button type="button" class="btn btn-danger btn-sm"
                                                                    disabled title="Cannot delete your own account"
                                                                    aria-label="Cannot delete your own account">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            @endif
                                                        </div>

                                                        @if ($user->id !== auth()->id())
                                                            <form id="delete-form-{{ $user->id }}"
                                                                action="{{ route('users.destroy', $user->id) }}"
                                                                method="POST" style="display: none;">
                                                                @csrf
                                                                @method('DELETE')
                                                            </form>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="text-center">No users found.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize DataTable
            $('#users-table').DataTable({
                responsive: true,
                language: {
                    search: "Search users:",
                    lengthMenu: "Show _MENU_ users per page",
                    info: "Showing _START_ to _END_ of _TOTAL_ users",
                    paginate: {
                        first: "First",
                        last: "Last",
                        next: "Next",
                        previous: "Previous"
                    }
                },
                order: [
                    [0, 'asc']
                ],
                columnDefs: [{
                        orderable: false,
                        targets: 4
                    } // Disable sorting on actions column
                ]
            });
        });

        function confirmDelete(userId, userName) {
            if (confirm(`Are you sure you want to delete user "${userName}"? This action cannot be undone.`)) {
                document.getElementById(`delete-form-${userId}`).submit();
            }
        }

        // Auto-hide alerts after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                const alerts = document.querySelectorAll('.alert');
                alerts.forEach(function(alert) {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                });
            }, 5000);
        });
    </script>
@endsection

@section('links')
    <style>
        .btn-group .btn {
            margin-right: 2px;
        }

        .btn-group .btn:last-child {
            margin-right: 0;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .badge {
            font-size: 0.75em;
        }

        .alert {
            margin-bottom: 1rem;
        }
    </style>
@endsection
