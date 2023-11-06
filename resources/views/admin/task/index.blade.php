@extends(Auth::user()->hasRole('Admin') ? 'admin.layouts.app' : 'manager.layouts.app')


@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Task</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Task</li>
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
                                    New Task
                                </button>
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">New Task
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('task.store') }}" method="post">
                                                    @csrf
                                                    <div class="col-xs-6 col-sm-6 col-md-12">
                                                        <div class="form-group">
                                                            <label for="selectedJobs">Select Jobs(Location Name):</label>
                                                            <select class="form-control select-form" id="selectedJobs"
                                                                name="job_id">
                                                                <option value="" disabled hidden selected>select job
                                                                </option>
                                                                @foreach ($jobs as $job)
                                                                    <option value="{{ $job->id }}">
                                                                        {{ $job->location_name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-6 col-sm-6 col-md-12">
                                                        <div class="form-group">
                                                            <label for="selectedJobs">Assign to user:</label>
                                                            <select class="form-control select-form" id="selectedJobs"
                                                                name="user_id">
                                                                <option value="" disabled hidden selected>select user
                                                                </option>
                                                                @foreach ($user as $job)
                                                                    <option value="{{ $job->id }}">{{ $job->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-6 col-sm-6 col-md-12">
                                                        <div class="form-group">
                                                            <label for="selectedJobs">Description:</label>
                                                            <input type="text" name="description" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-6 col-sm-6 col-md-12">
                                                        <div class="form-group">
                                                            <label for="selectedJobs">Type of Assignment:</label>
                                                            <input type="text" name="assignment" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-6 col-sm-6 col-md-12">
                                                        <div class="form-group">
                                                            <label for="selectedJobs">Due Date:</label>
                                                            <input type="datetime-local" name="due_date"
                                                                class="form-control">
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
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>S.N</th>
                                            <th>Job Location</th>
                                            <th>Assigned Manager</th>
                                            <th>Assigned User</th>
                                            <th>Description</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @if ($task)
                                            @foreach ($task as $key => $jobcat)
                                                <tr>
                                                    <td>
                                                        {{$key +1}}
                                                    </td>
                                                    <td>{{ isset($jobcat->jobs->location_name) ? $jobcat->jobs->location_name : 'null' }}
                                                    </td>
                                                    <td>{{ isset($jobcat->manager->name) ? $jobcat->manager->name : 'null' }}
                                                    </td>
                                                    <td>{{ isset($jobcat->users->name) ? $jobcat->users->name : 'null' }}
                                                    </td>
                                                    <td>{{ isset($jobcat->description) ? $jobcat->description : 'null' }}
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-success" data-toggle="modal"
                                                            data-target="#exampleModal{{ $jobcat->id }}">
                                                            Edit
                                                        </button>
                                                        <form action="{{ route('task.destroy', $jobcat->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger"
                                                                onclick="return confirm('Are you sure you want to delete this task?')">Delete</button>
                                                        </form>
                                                    </td>
                                                    <div class="modal fade" id="exampleModal{{ $jobcat->id }}"
                                                        tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Edit
                                                                        Task
                                                                    </h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="{{ route('task.update', $jobcat->id) }}"
                                                                        method="post">
                                                                        @csrf
                                                                        @method('PUT')

                                                                        <div class="col-xs-6 col-sm-6 col-md-12">
                                                                            <div class="form-group">
                                                                                <label for="selectedJobs">Assign to
                                                                                    user:</label>
                                                                                <select class="form-control select-form"
                                                                                    id="selectedJobs" name="user_id">
                                                                                    <option value="" disabled hidden
                                                                                        selected>select user
                                                                                    </option>
                                                                                    @foreach ($user as $job)
                                                                                        <option
                                                                                            {{ isset($jobcat->user_id) && $job->id == old('user_id', $jobcat->user_id) ? 'selected' : '' }}
                                                                                            value="{{ $job->id }}">
                                                                                            {{ ucfirst($job->name) }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-xs-6 col-sm-6 col-md-12">
                                                                            <div class="form-group">
                                                                                <label for="selectedJobs">Type of
                                                                                    Assignment:</label>
                                                                                <input type="text" name="assignment"
                                                                                    class="form-control"
                                                                                    value="{{ $jobcat->assignment }}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-xs-6 col-sm-6 col-md-12">
                                                                            <div class="form-group">
                                                                                <label for="selectedJobs">Due Date:</label>
                                                                                <input type="datetime-local"
                                                                                    name="due_date" class="form-control"
                                                                                    value="{{ $jobcat->due_date }}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-xs-6 col-sm-6 col-md-12">
                                                                            <div class="form-group">
                                                                                <label
                                                                                    for="selectedJobs">Description:</label>
                                                                                <textarea name="description" cols="30" rows="1" class="form-control">{{ isset($jobcat->description) ? old('description', $jobcat->description) : '' }}</textarea>

                                                                            </div>
                                                                        </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">Save
                                                                        changes</button>

                                                                </div>
                                                                </form>
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
