@extends(Auth::user()->hasRole('Admin') ? 'admin.layouts.app' : (Auth::user()->hasRole('vendor') ? 'vendor.layouts.app' : (Auth::user()->hasRole('account manager') ? 'manager.layouts.app' : (Auth::user()->hasRole('User') ? 'users.layouts.app': 'default.app'))))


@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Supply Request</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Supply Request</li>
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
                                <a class="btn btn-success" href="{{ route('supply.create') }}"
                                    class="btn btn-primary">Create Supply Request</a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Order #</th>
                                            <th>Order Ref#</th>
                                            <th>Order Progress</th>
                                            @if (auth()->user()->hasRole('Admin'))
                                            <th>Created By</th>
                                            @endif
                                            <th>Order Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset($supply))



                                        @foreach ($supply as $supplies)
                                            <tr>
                                                <td>{{ $supplies->id }}</td>
                                                <td>{{ $supplies->order_ref }}</td>
                                                <td>
                                                    @if ($supplies->order_progress === 'Open')
                                                        <span class="badge badge-success">Open</span>
                                                    @elseif ($supplies->order_progress === 'Close')
                                                        <span class="badge badge-danger">Close</span>
                                                    @endif
                                                </td>

                                                @if (auth()->user()->hasRole('Admin'))
                                                <td>{{ $supplies->user->name }}</td>
                                                @endif
                                                <td>{{ $supplies->order_date }}</td>
                                                <td>
                                                    <form action="{{ route('supply.destroy', $supplies->id) }}"
                                                        method="POST">
                                                        <a href="{{ route('supply.show', $supplies->id) }}"
                                                            class="btn btn-info">Show</a>
                                                        <a href="{{ route('supply.edit', $supplies->id) }}"
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
