@extends('vendor.layouts.app')


@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add images and notes</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Add images and notes</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <div class="container">
            <h1 class="mb-4">Complete Vendor Profile</h1>

            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Vendor Information</h5><br>
                            <dl class="row">
                                <dt class="col-sm-4">Vendor Name:</dt>
                                <dd class="col-sm-8">{{ isset($vendor) ? $vendor->name : '' }}</dd>
                            </dl>
                        </div>
                    </div>

                    <!-- Areas of Work and Services Performed -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title font-weight-bold">Areas of Work</h5>
                            <p class="card-text">{{ isset($vendor->userdetail) ? $vendor->userdetail->areas_of_work : '' }}</p>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title font-weight-bold">Services Performed</h5>
                            <p class="card-text">{{ isset($vendor->userdetail) ? $vendor->userdetail->services_performed : '' }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <!-- Upload Documents -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Upload Documents</h5><br>
                            <form method="POST" action="{{ route('company_profile.update',$vendor->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="inputTitle" class="col-form-label">Areas of Work</label>
                                  <input id="inputTitle" type="text" name="areas_of_work" placeholder="Enter areas of work"  value="{{$vendor->userdetail->areas_of_work ?? ''}}" class="form-control">
                                  @error('areas_of_work')
                                  <span class="text-danger">{{$message}}</span>
                                  @enderror
                                  </div>

                                  <div class="form-group">
                                      <label for="inputEmail" class="col-form-label">Services You Perform</label>
                                    <input  type="text" name="services_performed" placeholder="Enter services performed"  value="{{$vendor->userdetail->services_performed ?? ''}}" class="form-control">
                                    @error('services_performed')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                  </div>

                                <div class="form-group">
                                    <label for="document">Document</label>
                                    <input type="file" id="document" name="document[]" multiple class="form-control-file">
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Upload Documents</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Display Uploaded Documents -->
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Uploaded Documents</h5>
                            <ul>
                                @if (isset($vendor->files) && count($vendor->files) > 0)
                                <div class="mt-5">

                                    <div class="row">
                                        @foreach ($vendor->files as $file)
                                            <div class="col-md-4">
                                                <div class="card mb-4">
                                                    {{-- <img src="{{ asset('storage/' .$file->filename) }}" class="card-img-top"
                                                        > --}}
                                                    <div class="card-body">
                                                        <a href="{{ asset('storage/' .$file->filename) }}" target="blank">{{ basename($file->filename) }}</a>
                                                        {{-- <p class="card-text">{{ $file->filename }}</p> --}}
                                                        <form action="{{ route('company_profile.destroy', $file->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Are you sure you want to Delete this?')">Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
