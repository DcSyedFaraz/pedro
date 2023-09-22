@extends('manager.layouts.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Inspection Category</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Inspection Category</li>
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
                <button type="button" class="btn btn-success" data-toggle="modal"
                data-target="#exampleModal">
               New Inspection Category
            </button>
            <div class="modal fade" id="exampleModal" tabindex="-1"
                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title
                            </h5>
                            <button type="button" class="close" data-dismiss="modal"
                                aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('checklists.store') }}"
                                method="post">
                                @csrf
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <strong>New Sheet Name:</strong>
                                        <input type="text" class="form-control" name="name">
                                        <div id="checklist-items">
                                            <!-- Dynamic checklist items will be added here -->
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" id="add-checklist-item">Add Checklist Item</button>
                            <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save
                                changes</button>
                            <a href="">

                            </a>
                        </div>
                        </form>
                    </div>

                </div>
            </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Name</th>
                  <th>Total Rows</th>
                  <th>Actions</th>
                </tr>
                </thead>

                <tbody>
                  @if($checklist)
                  @foreach($checklist as $jobcat)
                  <tr>
                  <td>{{ $jobcat->name }}</td>
                  <td>{{ isset($jobcat->job_sub_category) ? $jobcat->job_sub_category->name : '0' }}</td>
                  <td>
                    <form action="{{ route('checklists.destroy', $jobcat->id) }}" method="post" style="display:inline">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to Remove this Sheet?')">Delete</button>
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
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>

@section('script')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
   $('#add-checklist-item').click(function () {
    var newChecklistItem = $(
        '<div class="my-2 new-checklist-item">' +

        '<input type="text" class="form-control my-custom-class" name="checklist_items[]" placeholder="Enter Checklist Item">' +


        '<div class="col-md-3 my-1">' +
        '<button type="button" class="btn btn-danger remove-checklist-item">Remove</button>' +

        '</div>' +
        '</div>'
    );

    $('#checklist-items').append(newChecklistItem);
});

$(document).on('click', '.remove-checklist-item', function () {
    $(this).closest('.new-checklist-item').remove();
});

</script>
@endsection


@endsection




