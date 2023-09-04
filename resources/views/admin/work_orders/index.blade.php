@extends('admin.layouts.app')

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
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Code</th>
                    <th>Description</th>
                    <th>Feedback</th>
                    <th>Order Complete</th>
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
                      <td>{{ $workOrder->code }}</td>
                      <td>{{ $workOrder->description }}</td>
                      <td>{{ $workOrder->feedback }}</td>
                      <td>
                        @if($workOrder->status == 1)
                          <span class="text-success" style="font-size: 16px;font-weight: bold;">Completed</span>
                        @elseif($workOrder->status == 2)
                        <span class="text-danger" style="font-size: 16px;font-weight: bold;">Rejected</span>
                        @else
                        <span class="text-warning" style="font-size: 16px;font-weight: bold;">Pending</span>
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


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>

@endsection


   

