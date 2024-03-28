@extends('vendor.layouts.app')


@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Estimate Request</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Estimate Request</li>
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
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>First Name:</th>
                                    <td>{{ $estimate->first_name }}</td>
                                </tr>
                                <tr>
                                    <th>Last Name:</th>
                                    <td>{{ $estimate->last_name }}</td>
                                </tr>
                                <tr>
                                    <th>Phone Number:</th>
                                    <td>{{ $estimate->phone_number }}</td>
                                </tr>
                                <tr>
                                    <th>Email:</th>
                                    <td>{{ $estimate->email }}</td>
                                </tr>
                                <tr>
                                    <th>Street Address:</th>
                                    <td>{{ $estimate->street_address }}</td>
                                </tr>
                                <tr>
                                    <th>City:</th>
                                    <td>{{ $estimate->city }}</td>
                                </tr>
                                <tr>
                                    <th>State:</th>
                                    <td>{{ $estimate->state }}</td>
                                </tr>
                                <tr>
                                    <th>Zip Code:</th>
                                    <td>{{ $estimate->zip_code }}</td>
                                </tr>
                                <tr>
                                    <th>Details:</th>
                                    <td>{{ $estimate->details }}</td>
                                </tr>
                                @if ($estimate->picture)
                                    <tr>
                                        <th>Picture:</th>
                                        <td>
                                            <img src="{{ asset('storage/' . $estimate->picture) }}" alt="User Picture"
                                                class="img-fluid">
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        <form action="{{ route('vendor_estimate_requests.update', $estimate->id) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="col-5">
                                    <div class="input-group mb-3">
                                        <input type="number" name="bid" class="form-control" value="{{ $userBid ? $userBid->bid : '' }}"
                                            placeholder="Write your bid" aria-label="Write your bid"
                                            aria-describedby="basic-addon2" {{ $userBid->bid != null ? 'disabled' : '' }}>
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">USD</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <button class="btn btn-indigo" {{ $userBid->bid != null ? 'disabled' : '' }}>Place Bid</button>
                                </div>
                            </div>
                        </form>
                        <a href="{{ route('vendor_estimate_requests.index') }}" class="btn btn-primary">Back to menu</a>
                    </div>
                </div>
                <!-- /.row -->
            </div>
        </section>
    </div>


    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
@endsection
