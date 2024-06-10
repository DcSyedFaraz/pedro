@extends('vendor.layouts.app')


@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ __('vendor/company/index.add_images_and_notes') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">{{ __('vendor/company/index.add_images_and_notes') }}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <div class="container">
            <h1 class="mb-4">{{ __('vendor/company/index.complete_vendor_profile') }}</h1>

            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Vendor Information</h5><br>
                            <dl class="row">
                                <dt class="col-sm-4">{{ __('vendor/company/index.vendor_name') }}:</dt>
                                <dd class="col-sm-8">{{ isset($vendor) ? $vendor->name : '' }}</dd>
                            </dl>
                        </div>
                    </div>

                    <!-- Areas of Work and Services Performed -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title font-weight-bold">{{ __('vendor/company/index.areas_of_work') }}</h5>
                            <p class="card-text">{{ isset($vendor->userdetail) ? $vendor->userdetail->areas_of_work : '' }}
                            </p>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title font-weight-bold">{{ __('vendor/company/index.services_performed') }}</h5>
                            <p class="card-text">
                                {{ isset($vendor->userdetail) ? $vendor->userdetail->services_performed : '' }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <!-- Upload Documents -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">{{ __('vendor/company/index.uploaded_documents') }}</h5><br>
                            <form method="POST" action="{{ route('company_profile.update', $vendor->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')


                                {{-- <label for="inputTitle" class="col-form-label">{{ __('vendor/company/index.areas_of_work') }}</label> --}}


                                <div class="form-group">
                                    <label for="example">{{ __('vendor/company/index.areas_of_work') }}</label>
                                    <select class="form-control js-example-basic-multiple text-black" name="areas_of_work[]" id="areas_of_work" multiple="multiple">
                                        <option hidden>Select Area Of Work</option>
                                        @forelse ($areas as $area)
                                            <option value="{{ $area->id }}">{{ $area->name }}</option>
                                        @empty
                                            <option>no Area Of Work available</option>
                                        @endforelse
                                    </select>

                                    {{-- <input id="inputTitle" type="text" name="areas_of_work" placeholder="Enter areas of work"  value="{{$vendor->userdetail->areas_of_work ?? ''}}" class="form-control"> --}}
                                    @error('areas_of_work')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    {{-- <label for="inputEmail" class="col-form-label">{{ __('vendor/company/index.services_you_perform') }}</label> --}}
                                    <label for="example">{{ __('vendor/company/index.services_you_perform') }}</label>
                                    <select class="form-control js-example-basic-multiple text-black" name="services_performed[]" id="services_performed" multiple="multiple">
                                        <option hidden>Select Services</option>
                                        @forelse ($services as $service)
                                            <option value="{{ $service->id }}">{{ $service->name }}</option>
                                        @empty
                                            <option>no services available</option>
                                        @endforelse
                                    </select>
                                    {{-- <input  type="text" name="services_performed" placeholder="Enter services performed"  value="{{$vendor->userdetail->services_performed ?? ''}}" class="form-control"> --}}
                                    @error('services_performed')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="document">{{ __('vendor/company/index.document') }}</label>
                                    <input type="file" id="document" name="document[]" multiple
                                        class="form-control-file">
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Uploaded Documents</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Display Uploaded Documents -->
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ __('vendor/company/index.uploaded_documents') }}</h5>
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
                                                            <a href="{{ asset('storage/' . $file->filename) }}"
                                                                target="blank">{{ basename($file->filename) }}</a>
                                                            {{-- <p class="card-text">{{ $file->filename }}</p> --}}
                                                            <form
                                                                action="{{ route('company_profile.destroy', $file->id) }}"
                                                                method="POST">
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
@section('scripts')
    <script>
        $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });
    </script>
@endsection
