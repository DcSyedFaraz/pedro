@extends('vendor.layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Work Order</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Work Order</li>
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
                            <div class="card-body table-responsive-xl">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>S.N</th>
                                            <th>Work Order#</th>
                                            <th>Job Name</th>
                                            <th>Vendor</th>
                                            <th>Status</th>
                                            <th>Deadline</th>
                                            <th>Payment</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <meta name="csrf-token" content="{{ csrf_token() }}">

                                        @if ($WorkOrders)
                                            @foreach ($WorkOrders as $key => $workOrder)
                                                <tr data-id="{{ $workOrder->id }}">
                                                    <td><a href="#"><i class="fas fa-arrows-alt cursor-pointer"></i></a>&nbsp;{{$key+1}}</td>
                                                    <td> {{ $workOrder->id ?? '' }}</td>
                                                    <td>{{ $workOrder->jobname->name ?? '' }}</td>
                                                    <td>{{ $workOrder->vendor->name ?? '' }}</td>
                                                    <td>
                                                        @switch($workOrder->status)
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
                                                                {{ $workOrder->status }}
                                                        @endswitch
                                                    </td>

                                                    <td>{{ $workOrder->deadline ?? '' }}</td>
                                                    <td> @switch($workOrder->payment_info)
                                                            @case('quick_pay')
                                                                <span class="badge bg-success">Quick Pay</span>
                                                            @break

                                                            @default
                                                                ----
                                                        @endswitch
                                                    </td>
                                                    <td>
                                                        @if ($workOrder->status == 'pending')
                                                            <!-- Show Accept Button -->
                                                            <a href="{{ route('vendor.accept', ['id' => $workOrder->id]) }}"
                                                                class="btn btn-sm btn-success"
                                                                onclick="return confirm('Are you sure you want to Accept this Work Order?')">
                                                                <i class="fa fa-check"></i> Accept
                                                            </a>
                                                            <!-- Show Decline Button -->
                                                            <a href="{{ route('vendor.decline', ['id' => $workOrder->id]) }}"
                                                                class="btn btn-sm btn-danger"
                                                                onclick="return confirm('Are you sure you want to Decline this Work Order?')">
                                                                <i class="fa fa-times"></i> Decline
                                                            </a>
                                                        @else
                                                            <a title="ask for quick pay"
                                                                href="{{ route('vendor.quick_pay', ['id' => $workOrder->id]) }}"
                                                                class="btn btn-sm btn-primary"
                                                                onclick="return confirm('Are you sure you want to Apply For Quick Pay?')">
                                                                <i class="fa fa-hand-holding-usd"></i>
                                                            </a>
                                                            <a title="add images and notes"
                                                                href="{{ route('vendor.doc', ['id' => $workOrder->id]) }}"
                                                                class="btn btn-sm btn-warning">
                                                                <i class="fa fa-plus"></i>
                                                            </a>
                                                            <a title="add images and notes"
                                                                href="{{ route('invoice.create', $workOrder->id) }}"
                                                                class="btn btn-sm btn-secondary">
                                                                Create Invoice
                                                            </a>
                                                        @endif
                                                        <a title="view details"
                                                            href="{{ route('manage_work_orders.show', $workOrder->job_id) }}"
                                                            class="btn btn-sm btn-info">View</a>
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
    </div>


@endsection
@section('scripts')
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> --}}

    <script>
        $(document).ready(function() {
            $(function() {
                var token = $('meta[name="csrf-token"]').attr('content');
                $("#example1 tbody").sortable({
                    update: function(event, ui) {
                        var newOrder = $(this).sortable('toArray', {
                            attribute: 'data-id'
                        });
                        updatePriorities(newOrder, token);
                    }
                });
                $("#example1").disableSelection();
            });

            function updatePriorities(newOrder, token) {
                $.ajax({
                    url: '{{ route('sort') }}',
                    type: 'POST',
                    data: {
                        _token: token,
                        order: newOrder
                    },
                    success: function(response) {
                        console.log('done');
                        if (response.error) {

                            toastr.error(response.error, 'Error', {
                                closeButton: false
                            });
                        } else {
                            toastr.success(response.message, 'Success', {
                                closeButton: true
                            });

                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            }
        });
    </script>
@endsection
