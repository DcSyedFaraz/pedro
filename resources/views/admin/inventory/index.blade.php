@extends('admin.layouts.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Inventory</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Inventory</li>
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
                <a class="btn btn-success" href="{{ route('inventory.create') }}" class="btn btn-primary">Create New Inventory</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Vendor</th>
                    <th>Date</th>
                    <th>Received By</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($inventory as $inv)
                <tr>
                    <td>{{ $inv->vendor }}</td>
                    <td>{{ $inv->date }}</td>
                    <td>{{ $inv->receive }}</td>
                    <td>
                        <form action="{{ route('inventory.destroy', $inv->id) }}" method="POST">
                            <a href="{{ route('inventory.show', $inv->id) }}" class="btn btn-info">Show</a>
                            <a href="{{ route('inventory.edit', $inv->id) }}" class="btn btn-primary">Edit</a>
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


@endsection




