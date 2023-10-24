@extends('users.layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Estimate List</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Estimate List</li>
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

                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Customer Name</th>
                                            <th>Jobs</th>
                                            <th>Assigned Manager</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                            <th>E-Signature</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @if ($job)
                                            @foreach ($job as $jobs)
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
                                                    <td>{{ isset($jobs->customer->name) ? $jobs->customer->name : '' }}</td>
                                                    <td>{{ isset($jobs->job_category->name) ? $jobs->job_category->name : '' }}
                                                    </td>
                                                    <td>
                                                        {{ isset($jobs->account_manager_id) ? $jobs->manager->name : 'null' }}
                                                    </td>
                                                    <td>
                                                        {{-- @dd($jobs->client_status) --}}
                                                        @switch($jobs->client_status)
                                                        @case('pending')
                                                            <span class="badge bg-warning">Pending</span>
                                                        @break

                                                        @case('accepted')
                                                            <span class="badge bg-success">Accepted</span>
                                                        @break

                                                        @case('declined')
                                                            <span class="badge bg-danger">Declined</span>
                                                        @break

                                                        @default
                                                            {{ $jobs->client_status }}
                                                    @endswitch
                                                    </td>

                                                    <td>
                                                        @if ($jobs->client_status == 'pending')

                                                        <a class="btn btn-success"
                                                            href="{{ route('users.accept', $jobs->id) }}" onclick="return confirm('Are Sure want to Accept this Estimate')"><i
                                                                class="fas fa-check"></i></a>

                                                        <a class="btn btn-danger"
                                                            href="{{ route('users.decline', $jobs->id) }}" onclick="return confirm('Are Sure want to Decline this Estimate')"><i
                                                                class="fas fa-times"></i></a>
                                                        @endif

                                                        <a class="btn btn-primary"
                                                            href="{{ route('estimate.show', $jobs->id) }}">show</a>
                                                    </td>
                                                    <td class="w-25">
                                                        @if (empty($jobs->signature))

                                                        <div class="d-flex">
                                                            <form method="POST" action="{{route('esignature',$jobs->id)}}" enctype="multipart/form-data">
                                                                @csrf
                                                            <input type="file" class="form-control form-control-sm w-75" id="formFile" name="signature" accept=".png,.jpg,.jpeg,.pdf,.doc,.docx">
                                                            <button class="btn btn-success btn-sm mt-2"><i
                                                                class="fas fa-check"></i></button></form>
                                                                {{-- <small>The signature must be a file of type: png, jpg, jpeg, pdf, doc, docx.</small> --}}
                                                            </div>
                                                            @else
                                                            <p class="badge badge-info">E-Signature Uploaded</p>
                                                            @endif
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


</html>


@endsection
