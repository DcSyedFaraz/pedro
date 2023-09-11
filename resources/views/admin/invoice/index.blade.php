@extends('admin.layouts.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Invoice</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Invoice</li>
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
                <a class="btn btn-success" href="{{ route('invoice.create') }}" class="btn btn-primary">Create New Invoice</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
            <thead class="thead-light">
                <tr>
                    <th>Description</th>
                    <th>Amount</th>
                    <th>Labour Time</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($invoice as $inv)
                <tr>
                    <td>{{ $inv->amount_description }}</td>
                    <td>{{ $inv->amount }}</td>
                    <td>{{ $inv->labor_time }}</td>
                    <td>
                        <form action="{{ route('invoice.destroy', $inv->id) }}" method="POST">
                            <a href="{{ route('invoice.show', $inv->id) }}" class="btn btn-info">Show</a>
                            <a href="{{ route('invoice.edit', $inv->id) }}" class="btn btn-primary">Edit</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
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




