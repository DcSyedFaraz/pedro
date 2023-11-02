@extends('users.layouts.app')

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
            {{-- <div class="card-header">
              <a class="btn btn-success" href="{{ route('work-orders.create') }}"> New Work Order </a>
            </div> --}}
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
                            {{-- <th>Payment</th> --}}
                            {{-- <th>Action</th> --}}
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
                        {{-- <td> @switch($workOrder->payment_info)

                            @case('quick_pay')
                              <span class="badge bg-success">Quick Pay</span>
                            @break
                            @default
                             ----
                          @endswitch</td> --}}
                        {{-- <td>
                            <a href="{{ route('work_orders.edit',$workOrder->id) }}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                            <a href="{{ route('work_orders.show',$workOrder->id) }}" class="btn btn-info"><i class="fas fa-eye"></i></a>
                        </td> --}}
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

<!-- model -->
<div class="modal fade" id="assignModal" tabindex="-1" role="dialog" aria-labelledby="assignModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Modal header -->
            <div class="modal-header">
                <h5 class="modal-title" id="assignModalLabel">Assign Vendor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <!-- Vendor assignment form -->
                <form action="{{ route('users.assign_vendor.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="work_order_id" id="work_order_id">

                    <div class="form-group">
                        <label for="vendor_id">Select Vendor:</label>
                        <select class="form-control" id="vendor_id" name="vendor_id">
                            @foreach($vendors as $vendor)
                                <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Assign</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Feedback-->
<div class="modal fade" id="feedbackModal" tabindex="-1" role="dialog" aria-labelledby="assignModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Modal header -->
            <div class="modal-header">
                <h5 class="modal-title" id="assignModalLabel">Feedback</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <!-- Vendor assignment form -->
                <form action="{{ route('users.complete.order') }}" method="POST">
                    @csrf
                    <input type="hidden" name="work_order_code" id="work_order_code">

                    <div class="form-group">
                        <label for="vendor_id">Order Status</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="">Select Menu</option>
                            <option value="1">Order Completed</option>
                            <option value="2">Order Rejected</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="vendor_id">Feedback</label>
                        <textarea name="feedback" class="form-control"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!--End Feedback-->


  </section>
  <!-- /.content -->
</div>



<!-- Button to trigger the modal -->




<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<script>

    $(document).ready(function() {
      $('.assign-vendor').click(function() {
            var workOrderId = $(this).data('workorder-id');
            $('#work_order_id').val(workOrderId);
            $('#assignModal').modal('show');
        });
    });


    $(document).ready(function() {
      $('.feedback').click(function() {
            var workOrderCode = $(this).data('workorder-code');
            $('#work_order_code').val(workOrderCode);
            $('#feedbackModal').modal('show');
        });
    });


</script>
@endsection




