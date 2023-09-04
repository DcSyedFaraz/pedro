@extends('admin.layouts.app')


@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Products</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit Products</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
    <div class="container-fluid">
    @if (count($errors) > 0)
  <div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
       @foreach ($errors->all() as $error)
         <li>{{ $error }}</li>
       @endforeach
    </ul>
  </div>
@endif
        <div class="row">
          <div class="col-12">
              <div class="card">
                  <div class="card-header">
                      <form action="{{ route('purchase-orders.update', $purchaseOrder->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="order_number">Order Number:</label>
                            <input type="text" class="form-control" id="order_number" name="order_number" value="{{ $purchaseOrder->order_number }}" required>
                        </div>
                        <div class="form-group">
                            <label for="order_date">Order Date:</label>
                            <input type="date" class="form-control" id="order_date" name="order_date" value="{{ $purchaseOrder->order_date }}" required>
                        </div>
                        <div class="form-group">
                            <label for="total_amount">Total Amount:</label>
                            <input type="number" class="form-control" id="total_amount" name="total_amount" value="{{ $purchaseOrder->total_amount }}" step="0.01" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                      </form>
                  </div>
              </div> 
          </div>   
        </div>
    </div>
</section>

</div>
@endsection