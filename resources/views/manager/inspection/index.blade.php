@extends(Auth::user()->hasRole('Admin') ? 'admin.layouts.app' : (Auth::user()->hasRole('vendor') ? 'vendor.layouts.app' : (Auth::user()->hasRole('account manager') ? 'manager.layouts.app' : 'default.layout')))

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Inspection Category</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Inspection Sheet</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <!-- <div class="card-header">
                      <h3 class="card-title">User Managment</h3>
                    </div> -->
                            <!-- /.card-header -->
                            <div class="card-header">
                                <button type="button" class="btn btn-success" data-toggle="modal"
                                    data-target="#exampleModal">
                                    New Inspection Sheet
                                </button>
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">New Inspection Sheet
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('checklists.store') }}" method="post">
                                                    @csrf
                                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                                        <div class="form-group">
                                                            <strong>New Sheet Name:</strong>
                                                            <input type="text" class="form-control" name="name">
                                                            <div id="checklist-items">
                                                                <!-- Dynamic checklist items will be added here -->
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-success" id="add-checklist-item">Add
                                                    Checklist Item</button>
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save
                                                    changes</button>
                                                <a href="">

                                                </a>
                                            </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>S. No</th>
                                            <th>Name</th>
                                            <th>Total Itmes</th>
                                            @if (auth()->user()->hasRole('Admin'))
                                                <th>Created By</th>
                                            @endif
                                            <th>Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @if ($checklist)
                                        <?php $i = 0; ?>
                                            @foreach ($checklist as $jobcat)
                                            <?php $i++; ?>
                                                <tr>
                                                    <td>{{ $i }}</td>
                                                    <td>{{ $jobcat->name }}</td>

                                                    <td>{{ $jobcat->checklistItems->count() ?? '0' }}</td>
                                                    @if (auth()->user()->hasRole('Admin'))
                                                        <td>{{ $jobcat->user->name ?? '' }}</td>
                                                    @endif
                                                    <td>
                                                        <button class="btn btn-primary" data-toggle="modal"
                                                            data-target="#checklistModal_{{ $jobcat->id }}">View
                                                            Checklist Items</button>
                                                        <form action="{{ route('checklists.destroy', $jobcat->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger"
                                                                onclick="return confirm('Are you sure you want to delete this Sheet?')">Delete</button>
                                                        </form>

                                                    </td>
                                                    <!-- Modal for Checklist Items -->
                                                    <div class="modal fade" id="checklistModal_{{ $jobcat->id }}"
                                                        tabindex="-1" role="dialog" aria-labelledby="checklistModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="checklistModalLabel">
                                                                        Checklist Items for {{ $jobcat->name }}</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <ul>

                                                                        <ul>
                                                                            @foreach ($jobcat->checklistItems as $item)
                                                                                <li>{{ $item->description }}</li>
                                                                            @endforeach
                                                                        </ul>

                                                                    </ul>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>

                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>




@endsection
