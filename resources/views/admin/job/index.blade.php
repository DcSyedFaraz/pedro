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
            <!-- <div class="card-header">
              <h3 class="card-title">User Managment</h3>
            </div> -->
           <!-- /.card-header -->
            <div class="card-header">
              <a class="btn btn-success" href="{{ route('job.create') }}"> Create Job </a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Jobs Name</th>
                  <th>Jobs</th>
                  <th>Primary Contact</th>
                 <th>Schedule</th>
                 <th>Actions</th>
                </tr>
                </thead>

                <tbody>
                  @if($job)
                  @foreach($job as $jobs)
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
                  <td>{{ isset($jobs->jobs->name) ? $jobs->jobs->name : '' }}</td>
                  <td>{{ isset($jobs->job_category->name) ? $jobs->job_category->name : '' }}</td>
                  <td>Primary Contact: {{ $jobs->first_name . '-' . $jobs->last_name }}
                    </br> {{ $emailList }}
                    </br> Phone: {{ $phone }} Ext: {{ $ext }}
                  </td>
                  @if($jobs->current_status == 1)
                    <td class="text-primary"><strong>{{ isset($jobs) ? $jobs->parsedStatus : '' }}</strong></td>
                  @elseif($jobs->current_status == 2)
                  <td class="text-secondary"><strong>{{ isset($jobs) ? $jobs->parsedStatus : '' }}</strong></td>
                  @elseif($jobs->current_status == 3)
                  <td class="text-warning"><strong>{{ isset($jobs) ? $jobs->parsedStatus : '' }}</strong></td>
                  @elseif($jobs->current_status == 4)
                  <td class="text-info"><strong>{{ isset($jobs) ? $jobs->parsedStatus : '' }}</strong></td>
                    @elseif($jobs->current_status == 5)
                    <td class="text-light bg-dark"><strong>{{ isset($jobs) ? $jobs->parsedStatus : '' }}</strong></td>
                  @elseif($jobs->current_status == 6)
                  <td class="text-dark"><strong>{{ isset($jobs) ? $jobs->parsedStatus : '' }}</strong></td>
                    @elseif($jobs->current_status == 7)
                    <td class="text-danger"><strong>{{ isset($jobs) ? $jobs->parsedStatus : '' }}</strong></td>
                  @elseif($jobs->current_status == 8)
                  <td class="text-muted"><strong>{{ isset($jobs) ? $jobs->parsedStatus : '' }}</strong></td>
                    @elseif($jobs->current_status == 9)
                    <td class="text-success"><strong>{{ isset($jobs) ? $jobs->parsedStatus : '' }}</strong></td>
                    @else
                    <td class="text-success"><strong>---</strong></td>
                  @endif
                  <td>
                    <a class="btn btn-primary" href="{{ route('job.edit',$jobs->id) }}">Edit</a>
                      {!! Form::open(['method' => 'DELETE','route' => ['job.destroy', $jobs->id],'style'=>'display:inline']) !!}
                          {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                      {!! Form::close() !!}
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
