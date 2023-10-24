@extends(Auth::user()->hasRole('Admin') ? 'admin.layouts.app' :  'manager.layouts.app' )


@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Work Order List</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Work Order List</li>
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
            <div class="card-header">
                <a class="btn btn-success" href="{{ route('work_orders.create') }}"> Create Work Order </a>
            </div>
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
                  @if($WorkOrders)

                  @foreach($WorkOrders as $workOrder)


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
                      @endswitch</td>
                    <td>
                        <a href="{{ route('work_orders.edit',$workOrder->id) }}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                        <a href="{{ route('work_orders.show',$workOrder->id) }}" class="btn btn-info"><i class="fas fa-eye"></i></a>
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




