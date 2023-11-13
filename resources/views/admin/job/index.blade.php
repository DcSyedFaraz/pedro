@extends(Auth::user()->hasRole('Admin') ? 'admin.layouts.app' : 'manager.layouts.app')


@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Job List</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Job List</li>
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
                                <a class="btn btn-success" href="{{ route('job.create') }}"> Create Job </a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>S.N</th>
                                            <th>Customer Name</th>
                                            <th>Location Name</th>
                                            <th>Assigned Manager</th>
                                            <th>Status</th>
                                            <th>Created at</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @if ($job)
                                            @foreach ($job as $key => $jobs)
                                                @php
                                                    $phones = isset($jobs->phone) ? $jobs->phone : [];
                                                    $ext_ids = isset($jobs->ext_id) ? $jobs->ext_id : [];
                                                    $exts = isset($jobs->ext) ? $jobs->ext : [];
                                                    $emailAddresses = isset($jobs->email) ? $jobs->email : [];
                                                    $phone = implode(',', $phones);
                                                    $ext_id = implode(',', $ext_ids);
                                                    $ext = implode(',', $exts);
                                                    $emailList = implode(',', $emailAddresses);
                                                @endphp
                                                <tr>
                                                    <td>{{ $key+1 }}</td>
                                                    <td>{{ isset($jobs->customer->name) ? $jobs->customer->name : '' }}</td>
                                                    <td>{{ isset($jobs->location_name) ? $jobs->location_name : '' }}
                                                    </td>
                                                    <td>
                                                        {{ isset($jobs->account_manager_id) ? $jobs->manager->name : 'null' }}
                                                    </td>
                                                    @php
                                                        $statusClasses = [
                                                            1 => 'text-primary',
                                                            2 => 'text-secondary',
                                                            3 => 'text-warning',
                                                            4 => 'text-info',
                                                            5 => 'text-light bg-dark',
                                                            6 => 'text-dark',
                                                            7 => 'text-danger',
                                                            8 => 'text-muted',
                                                            9 => 'text-success',
                                                        ];
                                                        $parsedStatus = isset($jobs) ? $jobs->parsedStatus : '---';
                                                        $currentStatus = isset($jobs) ? $jobs->current_status : null;
                                                    @endphp

                                                    <td class="{{ $statusClasses[$currentStatus] ?? 'text-success' }}">
                                                        <strong>{{ $parsedStatus }}</strong>
                                                    </td>
<td>
    {{ $jobs->created_at->diffforhumans() }}
</td>
                                                    <td>
                                                        <button type="button" class="btn-sm btn btn-success"
                                                            data-toggle="modal"
                                                            data-target="#exampleModal{{ $jobs->id }}">
                                                            Assign
                                                        </button>
                                                        <a class="btn-sm btn btn-primary"
                                                            href="{{ route('job.edit', $jobs->id) }}">Edit</a>
                                                        <form action="{{ route('job.destroy', $jobs->id) }}" method="POST"
                                                            class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn-sm btn btn-danger"
                                                                onclick="return confirm('Are you sure you want to delete this job?')">Delete</button>
                                                        </form>

                                                    </td>
                                                </tr>
                                                <div class="modal fade" id="exampleModal{{ $jobs->id }}" tabindex="-1"
                                                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Modal title
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{ route('jobassign.update', $jobs->id) }}"
                                                                    method="post">
                                                                    @csrf
                                                                    @method('put')
                                                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                                                        <div class="form-group">
                                                                            <strong>Account Manager:</strong>
                                                                            <select name="account_manager_id"
                                                                                class="form-control select-form ">
                                                                                <option value="">Choose any
                                                                                    option</option>
                                                                                @foreach ($manager as $data)
                                                                                    <option
                                                                                        {{ isset($jobs->account_manager_id) && $data->id == old('account_manager_id', $jobs->account_manager_id) ? 'selected' : '' }}
                                                                                        value="{{ $data->id }}">
                                                                                        {{ ucfirst($data->name) }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                            </div>
                                                            <div class="modal-footer">
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

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>


@endsection
