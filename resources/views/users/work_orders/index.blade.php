@extends('users.layouts.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>DataTables</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">DataTables</li>
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
              <a class="btn btn-success" href="{{ route('work-orders.create') }}"> New Work Order </a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                <th>S/No</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Order Code</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                
                <tbody>
                  @if($WorkOrders)
                  <?php $i = 0; ?>
                  @foreach($WorkOrders as $workOrder)
                   <?php $i++; ?>
                  <tr>
                      <td>{{ $i }}</td>
                      <td>{{ $workOrder->title }}</td>
                      <td>{{ $workOrder->description }}</td>
                      <td>{{ $workOrder->code }}</td>
                      <td>
                        @if($workOrder->status == 1)
                          <span class="text-success" style="font-size: 16px;font-weight: bold;">Completed</span>
                        @elseif($workOrder->status == 2)
                        <span class="text-danger" style="font-size: 16px;font-weight: bold;">Rejected</span>
                        @else
                        <span class="text-warning" style="font-size: 16px;font-weight: bold;">Pending</span>
                        @endif
                      
                      </td>
                      <td>
                        <a class="btn btn-info" href="{{ route('work-orders.show',$workOrder->id) }}"><i class="fa fa-eye"></i></a>
                        <a class="btn btn-primary" href="{{ route('work-orders.edit',$workOrder->id) }}"><i class="fa fa-edit"></i></a>
                        {!! Form::open(['method' => 'DELETE', 'route' => ['work-orders.destroy', $workOrder->id], 'style' => 'display:inline']) !!}
                            {!! Form::button('<i class="fas fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                          <a href="#" class="assign-vendor btn btn-warning" data-toggle="modal" data-target="#assignModal{{ $workOrder->id }}" data-workorder-id="{{ $workOrder->id }}"><i class="fas fa-user-plus"></i></a>
                          @if($workOrder->deliver_status == 1)
                          <a href="#" class="feedback btn btn-danger" data-toggle="modal" data-target="#feedbackModal{{ $workOrder->code }}" data-workorder-code="{{ $workOrder->code }}"><i class="fas fa-comment"></i></a>
                          @else
                          <a href="#" class="feedback btn btn-danger" style="display:none" data-toggle="modal" data-target="#feedbackModal{{ $workOrder->code }}" data-workorder-code="{{ $workOrder->code }}"><i class="fas fa-comment"></i></a>
                         
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
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
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


   

