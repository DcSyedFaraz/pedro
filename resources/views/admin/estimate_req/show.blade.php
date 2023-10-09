@extends('admin.layouts.app')

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
                                            <img src="{{ asset('storage/' . $estimate->picture) }}" alt="User Picture" class="img-fluid">
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>

                        <a href="{{ route('estimate_requests.index') }}" class="btn btn-primary">Back to Users</a>
                    </div>
                </div>
                <!-- /.row -->
            </div>
        </section>
    </div>


    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
@endsection
