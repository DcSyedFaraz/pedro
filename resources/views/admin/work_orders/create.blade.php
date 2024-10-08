@extends(Auth::user()->hasRole('Admin')? 'admin.layouts.app' :  'manager.layouts.app' )

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ __('admin/work_order/edit.create_work_order') }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">{{ __('admin/work_order/edit.create_work_order') }}</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('admin/work_order/edit.create_work_order') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('work_orders.store') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="job_id" class="col-md-4 col-form-label text-md-right">{{ __('admin/work_order/edit.job_id') }}</label>
                                <div class="col-md-6">
                                    <select id="job_id" name="job_id" class="form-control">
                                        <!-- Populate this select input with job options from your database -->
                                        @foreach($jobs as $job)
                                            <option value="{{ $job->id }}">{{ $job->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('job_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="vendor_id" class="col-md-4 col-form-label text-md-right">{{ __('Vendor ID') }}</label>
                                <div class="col-md-6">
                                    <select id="vendor_id" name="vendor_id" class="form-control">
                                        <!-- Populate this select input with vendor options from your database -->
                                        @foreach($vendors as $vendor)
                                            <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('vendor_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="deadline" class="col-md-4 col-form-label text-md-right">{{ __('admin/work_order/edit.deadline') }}</label>
                                <div class="col-md-6">
                                    <input id="deadline" type="date" class="form-control @error('deadline') is-invalid @enderror" name="deadline" value="{{ old('deadline') }}" required>
                                    @error('deadline')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('admin/work_order/edit.create_work_order') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

</div>
@endsection
