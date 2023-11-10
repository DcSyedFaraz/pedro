@extends(Auth::user()->hasRole('Admin') ? 'admin.layouts.app' : 'manager.layouts.app')


@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Estimates</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Estimates</li>
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
                                <a class="btn btn-success" href="{{ route('estimates.create') }}"> Create Estimates </a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Customer Name</th>
                                            <th>Jobs</th>
                                            <th>Primary Contact</th>
                                            <th>E-Signature</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @if ($estimates)
                                            @foreach ($estimates as $estimate)
                                                @php
                                                    $phones = isset($estimate->phone) ? $estimate->phone : [];
                                                    $ext_ids = isset($estimate->ext_id) ? $estimate->ext_id : [];
                                                    $exts = isset($estimate->ext) ? $estimate->ext : [];
                                                    $emailAddresses = isset($estimate->email) ? $estimate->email : [];
                                                    $phone = implode(',', $phones);
                                                    $ext_id = implode(',', $ext_ids);
                                                    $ext = implode(',', $exts);
                                                    $emailList = implode(',', $emailAddresses);
                                                @endphp
                                                <tr>
                                                    <td>{{ isset($estimate->customer->name) ? $estimate->customer->name : '' }}
                                                    </td>
                                                    <td>{{ isset($estimate->job_category->name) ? $estimate->job_category->name : '' }}
                                                    </td>
                                                    <td>Primary Contact:
                                                        {{ $estimate->first_name . '-' . $estimate->last_name }}
                                                        </br> {{ $emailList }}
                                                        </br> Phone: {{ $phone }} Ext: {{ $ext }}
                                                    </td>
                                                    <td>
                                                        @if (isset($estimate->signature))
                                                            <a href="{{ $estimate->signature }}" target="blank"
                                                                class="btn btn-warning">E-Signature</a>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        {{-- @if (!empty($estimate->jobs))
                                                            <span class="badge badge-primary">Converted to job</span>
                                                        @else
                                                            <form
                                                                action="{{ route('estimates.updateSelectedJobs', $estimate) }}"
                                                                method="POST" class="d-inline">
                                                                @csrf
                                                                <button type="submit" class="btn btn-primary dltBtn" data-id="{{ $estimate->id }}"
                                                                   >Convert</button>
                                                            </form>
                                                        @endif --}}
                                                        <a class="btn btn-success"
                                                            href="{{ route('estimates.edit', $estimate->id) }}">Edit</a>
                                                        <form action="{{ route('estimates.destroy', $estimate) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger"
                                                                onclick="return confirm('Are you sure you want to delete this estimate?')">Delete</button>
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
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>


    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.dltBtn').click(function(e) {
                var form = $(this).closest('form');
                var dataID = $(this).data('id');
                // alert(dataID);
                e.preventDefault();
                swal({

                        title: "Confirmation",
                        text: "Are you sure you want to convert this estimate to a job?",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            form.submit();
                        } else {
                            swal("This estimate has not been converted to a job!");
                        }
                    });
            })
        })
    </script>
@endsection
