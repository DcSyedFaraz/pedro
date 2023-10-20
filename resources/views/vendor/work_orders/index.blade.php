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
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Work Order ID</th>
                                            <th>Job Name</th>
                                            <th>Vendor</th>
                                            <th>Status</th>
                                            <th>Deadline</th>
                                            <th>Payment</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @if ($WorkOrders)
                                            @foreach ($WorkOrders as $workOrder)
                                                <tr>
                                                    <td>{{ $workOrder->id ?? '' }}</td>
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
                                                                class="btn btn-success"
                                                                onclick="return confirm('Are you sure you want to Accept this Work Order?')">
                                                                <i class="fa fa-check"></i> Accept
                                                            </a>
                                                            <!-- Show Decline Button -->
                                                            <a href="{{ route('vendor.decline', ['id' => $workOrder->id]) }}"
                                                                class="btn btn-danger"
                                                                onclick="return confirm('Are you sure you want to Decline this Work Order?')">
                                                                <i class="fa fa-times"></i> Decline
                                                            </a>
                                                        @else
                                                            <a title="ask for quick pay"
                                                                href="{{ route('vendor.quick_pay', ['id' => $workOrder->id]) }}"
                                                                class="btn btn-primary"
                                                                onclick="return confirm('Are you sure you want to Apply For Quick Pay?')">
                                                                <i class="fa fa-hand-holding-usd"></i>
                                                            </a>
                                                            <a title="add images and notes"
                                                                href="{{ route('vendor.doc', ['id' => $workOrder->id]) }}"
                                                                class="btn btn-warning">
                                                                <i class="fa fa-plus"></i>
                                                            </a>
                                                            <a title="add images and notes"
                                                                href="{{ route('invoice.create', $workOrder->id) }}"
                                                                class="btn btn-secondary">
                                                                Create Invoice
                                                            </a>
                                                        @endif
                                                        <a title="view details"
                                                            href="{{ route('manage_work_orders.show', $workOrder->job_id) }}"
                                                            class="btn btn-info">View</a>
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
