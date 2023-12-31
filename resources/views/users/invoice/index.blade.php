@extends('users.layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Invoices List</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Invoices List</li>
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

                            {{-- <!-- /.card-header -->
                            <div class="card-header">
                                <a class="btn btn-success" href="{{ route('invoice.create') }}"
                                    class="btn btn-primary">Create New Invoice</a>
                            </div> --}}
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Date</th>
                                            <th>Customer Name</th>
                                            <th>Invoice#</th>
                                            <th>PO#</th>
                                            <th>Status</th>
                                            <th>Total</th>
                                            <th>Total Due</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @dd($recur) --}}
                                        @if ($invoices->isEmpty())

                                        <tr>
                                            <td class="text-center" colspan="8">
                                                No Records Availabe

                                            </td>
                                        </tr>
                                        @else
                                        @foreach ($invoices as $inv)
                                            <tr>
                                                <td>{{ Carbon\Carbon::parse($inv->updated_at)->format('l, F j, Y h:i A')  }}</td>
                                                <td>{{ isset($inv->job->customer->name) ? $inv->job->customer->name : 'N/A' }}</td>
                                                <td>{{ $inv->id }}</td>
                                                <td>{{ isset($inv->job) ? $inv->job->po_no : 'N/A' }}</td>
                                                <td class="">
                                                    @if ($inv->status === 'unpaid')
                                                        <label class="badge badge-danger">{{ Str::ucfirst($inv->status) }}</label>
                                                    @elseif ($inv->status === 'paid')
                                                        <label class="badge badge-success">{{ Str::ucfirst($inv->status) }}</label>
                                                    @elseif ($inv->status === 'recurring')
                                                        <label class="badge badge-warning">{{ Str::ucfirst($inv->status) }}</label>
                                                    @endif
                                                </td>

                                                <td>{{ isset($inv->unpaid) ? $inv->unpaid->total : 'N/A' }}
                                                </td>
                                                <td>{{ isset($inv->unpaid) ? $inv->unpaid->total : 'N/A' }}
                                                </td>
                                                <td class="btn-group">
                                                    <a href="{{ route('invoices.show', $inv->id) }}"
                                                        class="btn btn-info "><i class="fa fa-eye"></i></a>
                                                        &nbsp;
                                                        {{-- <a href="{{ route('invoice.edit', $inv->id) }}"
                                                            class="btn btn-primary"><i class="fa fa-edit"></i></a> --}}
                {{-- <form action="{{ route('invoice.destroy', $inv->id) }}" method="POST"
                                                                class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger"
                                                                    onclick="return confirm('Are you sure you want to delete this task?')">Delete</button>
                                                            </form> --}}
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
