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
              <a class="btn btn-success" href="{{ route('estimates.create') }}"> Create Estimates </a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Customer Name</th>
                    <th>Jobs</th>
                    <th>Primary Contact</th>
                    <th>Actions</th>
                  </tr>
                </thead>

                <tbody>
                  @if($estimates)
                    @foreach($estimates as $estimate)
                      @php
                        $phones = isset($estimate->phone) ? $estimate->phone : [];
                        $ext_ids = isset($estimate->ext_id) ? $estimate->ext_id : [];
                        $exts = isset($estimate->ext) ? $estimate->ext : [];
                        $emailAddresses = isset($estimate->email) ? $estimate->email : [];
                        $phone = implode(',', $phones);
                        $ext_id = implode(',', $ext_ids);
                        $ext = implode(',', $exts);
                        $emailList = implode(',', $emailAddresses);
                      @endphp
                      <tr>
                          <td>{{ isset($estimate->customer->name) ? $estimate->customer->name : '' }}</td>
                          <td>{{ isset($estimate->job_category->name) ? $estimate->job_category->name : '' }}</td>
                          <td>Primary Contact: {{ $estimate->first_name . '-' . $estimate->last_name }}
                          </br> {{ $emailList }}
                          </br> Phone: {{ $phone }} Ext: {{ $ext }}
                          </td>
                          <td>
                          <!-- <a href="{{ route('estimates.edit', $estimate) }}" class="btn btn-primary">Edit</a> -->
                          <a class="btn btn-success" href="{{ route('estimates.edit',$estimate->id) }}">Edit</a>
                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#markModal" data-estimate-id="{{ $estimate->id }}">Mark</button>
                          <form action="{{ route('estimates.destroy', $estimate) }}" method="POST" class="d-inline">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this estimate?')">Delete</button>
                          </form>
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

      <!--Start Modal -->
      <div class="modal fade" id="markModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Mark Selected Jobs</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                  <form action="{{ route('estimates.updateSelectedJobs') }}" method="POST">
                    @csrf
                    <input type="hidden" name="estimate_id" id="estimate_id" value="">
                    <div class="form-group">
                      <label for="selectedJobs">Select Jobs:</label>
                      <select multiple class="form-control" id="selectedJobs" name="selectedJobs[]">
                          @foreach ($jobs as $job)
                              <option value="{{ $job->id }}">{{ $job->job_category->name }}</option>
                          @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="markDescription">Mark Description:</label>
                      <textarea class="form-control" id="markDescription" name="markDescription" rows="3"></textarea>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Mark</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- End Model -->

      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<script>
     $(document).ready(function() {
        $('#markModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var estimateId = button.data('estimate-id'); // Extract info from data-* attributes
            var modal = $(this);
            // Update the hidden input field with the estimate ID
            modal.find('#estimate_id').val(estimateId);
            // Clear any previous selections and description
            modal.find('#selectedJobs').val([]);
            modal.find('#markDescription').val('');
        });
    });
</script>
@endsection
