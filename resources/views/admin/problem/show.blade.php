@extends(Auth::user()->hasRole('Admin') ? 'admin.layouts.app' :  'manager.layouts.app' )



@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
       <!-- Custom CSS -->
          <style>




            .table {
              margin-bottom: 20px;
            }

            .submit-button {
              margin-top: 20px;
              background-color: #007bff;
              color: white;
            }
          </style>




          <div class="container">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Problem Report #{{ $problemReport->id }}</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <table class="table table-bordered">
                      <tbody>
                        <tr>
                          <th>Job</th>
                          <td>{{ $problemReport->job }}</td>
                        </tr>
                        <tr>
                          <th>Created By</th>
                          <td>{{ $problemReport->usname->name ?? '' }}</td>
                        </tr>
                        <tr>
                          <th>Location</th>
                          <td>{{ $problemReport->location }}</td>
                        </tr>
                        <tr>
                          <th>Type</th>
                          <td>
                            @if ($problemReport->type_of_problem === 'critical')
                              <span class="badge badge-danger">Critical</span>
                            @elseif ($problemReport->type_of_problem === 'high')
                              <span class="badge badge-warning">High</span>
                            @elseif ($problemReport->type_of_problem === 'medium')
                              <span class="badge badge-info">Medium</span>
                            @elseif ($problemReport->type_of_problem === 'low')
                              <span class="badge badge-success">Low</span>
                            @endif
                          </td>
                        </tr>

                        <tr>
                          <th>Problem Date</th>
                          <td>{{ $problemReport->problem_date }}</td>
                        </tr>
                        <tr>
                          <th>Investigator</th>
                          <td>{{ $problemReport->investigator_of_problem }}</td>
                        </tr>
                        <tr>
                          <th>Result of Investigation</th>
                          <td>{{ $problemReport->result_of_investigation }}</td>
                        </tr>
                        <tr>
                          <th>Suggestions</th>
                          <td>{{ $problemReport->suggestions }}</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <a href="{{ route('problem.index') }}" class="btn btn-primary">Back to List</a>
                    <a href="{{ route('problem.edit', $problemReport->id) }}" class="btn btn-info">Edit</a>
                    <form action="{{ route('problem.destroy', $problemReport->id) }}" method="post" style="display:inline">
                      @method('DELETE')
                      @csrf
                      <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this Report?')">Delete</button>
                    </form>
                  </div>
                </div>
                <!-- /.card -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.container -->



    </section>
</div>
@endsection
