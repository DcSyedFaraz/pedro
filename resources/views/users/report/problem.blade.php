@extends('users.layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Problem Reports</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Problem Reports</li>
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

                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Job Name</th>
                                            <th>Location</th>
                                            <th>Type</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset($problemReports))

                                        @foreach ($problemReports as $report)
                                        <tr>
                                            <td>{{ $report->id }}</td>
                                            <td>{{ $report->jobname->name }}</td>
                                            <td>{{ $report->location }}</td>
                                            <td>
                                                @if ($report->type_of_problem === 'critical')
                                                    <span class="badge badge-danger">Critical</span>
                                                @elseif ($report->type_of_problem === 'high')
                                                    <span class="badge badge-warning">High</span>
                                                @elseif ($report->type_of_problem === 'medium')
                                                    <span class="badge badge-info">Medium</span>
                                                @elseif ($report->type_of_problem === 'low')
                                                    <span class="badge badge-success">Low</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('users.problem.show', $report->id) }}" class="btn btn-info">View</a>
                                                {{-- <a href="{{ route('problem.edit', $report->id) }}" class="btn btn-primary">Edit</a> --}}
                                                {{-- Add delete button or other actions here --}}
                                            </td>
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


    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>


@endsection
