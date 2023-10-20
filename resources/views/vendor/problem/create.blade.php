@extends('vendor.layouts.app')


@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Problem Reporting</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Create New Report</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">


        <div class="container mt-5">
            <form action="{{ route('userproblem.store') }}" method="post">
                @csrf

                <div class="form-group">
                     <label for="job">Job:</label>
                    <select name="job" id="job" class="form-control">
                        <option value="">Select Job</option>
                        @foreach ($job as $cust)
                            <option value="{{ $cust->id }}" >
                                {{ $cust->name }}
                            </option>
                        @endforeach
                    </select>
                </div>



                <div class="form-group">
                    <label for="location">Location:</label>
                    <input type="text" name="location" id="location" class="form-control">
                </div>



                <div class="form-group">
                    <label for="location_supervisor">Location Supervisor:</label>
                    <input type="text" name="location_supervisor" id="location_supervisor" class="form-control">
                </div>

                <div class="form-group">
                    <label for="problem_details">Problem Details:</label>
                    <textarea name="problem_details" id="problem_details" class="form-control" rows="4"></textarea>
                </div>

                <div class="form-group">
                    <label for="problem_date">Problem Date:</label>
                    <input type="date" name="problem_date" id="problem_date" class="form-control">
                </div>

                <div class="form-group">
                    <label for="type_of_problem">Type of Problem:</label>
                    <select name="type_of_problem" id="type_of_problem" class="form-control">
                        <option value="critical">Critical</option>
                        <option value="high">High</option>
                        <option value="medium">Medium</option>
                        <option value="low">Low</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="description_of_problem">Description of Problem:</label>
                    <textarea name="description_of_problem" id="description_of_problem" class="form-control" rows="4"></textarea>
                </div>
                <div class="form-group">
                    <label for="investigator_of_problem">Investigator of Problem:</label>
                    <input type="text" name="investigator_of_problem" id="investigator_of_problem" class="form-control">
                </div>

                <div class="form-group">
                    <label for="result_of_investigation">Result of Investigation:</label>
                    <textarea name="result_of_investigation" id="result_of_investigation" class="form-control"></textarea>
                </div>

                <div class="form-group">
                    <label for="suggestions">Suggestions:</label>
                    <textarea name="suggestions" id="suggestions" class="form-control"></textarea>
                </div>

                <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>

</section>

</div>
@endsection
