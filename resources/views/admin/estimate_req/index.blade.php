@extends(Auth::user()->hasRole('Admin') ? 'admin.layouts.app' :  'manager.layouts.app' )


@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Estimate Request</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Estimate Request</li>
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
                                <a class="btn btn-success" href="{{ route('estimate_requests.create') }}"
                                    class="btn btn-primary">Create Estimate Request</a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Request #</th>
                                            <th>Name</th>
                                            <th>Phone #</th>
                                            @if (auth()->user()->hasRole('Admin'))
                                            <th>Created By</th>
                                            @endif
                                            <th>Email</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset($estimate))



                                        @foreach ($estimate as $supplies)
                                            <tr>
                                                <td>{{ $supplies->id }}</td>
                                                <td>{{ $supplies->first_name.' '.$supplies->last_name }}</td>
                                                <td>
                                                    {{ $supplies->phone_number }}
                                                </td>

                                                @if (auth()->user()->hasRole('Admin'))
                                                <td>{{ $supplies->users->name }}</td>
                                                @endif
                                                <td>{{ $supplies->email }}</td>
                                                <td>
                                                    <form action="{{ route('estimate_requests.destroy', $supplies->id) }}"
                                                        method="POST">
                                                        <a href="{{ route('estimate_requests.show', $supplies->id) }}"
                                                            class="btn btn-info">Show</a>
                                                        <a href="{{ route('estimate_requests.edit', $supplies->id) }}"
                                                            class="btn btn-primary">Edit</a>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this Request?')">Delete</button>
                                                    </form>
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
