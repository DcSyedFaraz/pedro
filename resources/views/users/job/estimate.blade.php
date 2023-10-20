@extends('users.layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Estimate List</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Estimate List</li>
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

                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Customer Name</th>
                                            <th>Jobs</th>
                                            <th>Assigned Manager</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                            <th>E-Signature</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @if ($job)
                                            @foreach ($job as $jobs)
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
                                                    <td>{{ isset($jobs->customer->name) ? $jobs->customer->name : '' }}</td>
                                                    <td>{{ isset($jobs->job_category->name) ? $jobs->job_category->name : '' }}
                                                    </td>
                                                    <td>
                                                        {{ isset($jobs->account_manager_id) ? $jobs->manager->name : 'null' }}
                                                    </td>
                                                    <td>
                                                        {{-- @dd($jobs->client_status) --}}
                                                        @switch($jobs->client_status)
                                                        @case('pending')
                                                            <span class="badge bg-warning">Pending</span>
                                                        @break

                                                        @case('accepted')
                                                            <span class="badge bg-success">Accepted</span>
                                                        @break

                                                        @case('declined')
                                                            <span class="badge bg-danger">Declined</span>
                                                        @break

                                                        @default
                                                            {{ $jobs->client_status }}
                                                    @endswitch
                                                    </td>

                                                    <td>
                                                        @if ($jobs->client_status == 'pending')

                                                        <a class="btn btn-success"
                                                            href="{{ route('users.accept', $jobs->id) }}" onclick="return confirm('Are Sure want to Accept this Estimate')"><i
                                                                class="fas fa-check"></i></a>

                                                        <a class="btn btn-danger"
                                                            href="{{ route('users.decline', $jobs->id) }}" onclick="return confirm('Are Sure want to Decline this Estimate')"><i
                                                                class="fas fa-times"></i></a>
                                                        @endif

                                                        <a class="btn btn-primary"
                                                            href="{{ route('estimate.show', $jobs->id) }}">show</a>
                                                    </td>
                                                    <td>
                                                        {{-- <div>
                                                            <canvas id="signatureCanvas" width="300" height="100"></canvas>
                                                            <button id="clearSignature">Clear Signature</button>
                                                            <button id="saveSignature">Save Signature</button>
                                                        </div> --}}
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

<!-- Add this script at the end of your HTML body or in your JavaScript file -->
{{-- <script>
    const canvas = document.getElementById('signatureCanvas');
    const context = canvas.getContext('2d');
    const clearButton = document.getElementById('clearSignature');
    const saveButton = document.getElementById('saveSignature');

    let drawing = false;

    canvas.addEventListener('mousedown', () => {
        drawing = true;
    });

    canvas.addEventListener('mouseup', () => {
        drawing = false;
        context.beginPath();
    });

    canvas.addEventListener('mousemove', draw);

    clearButton.addEventListener('click', clearSignature);
    saveButton.addEventListener('click', saveSignature);

    function draw(e) {
        if (!drawing) return;
        context.lineWidth = 2;
        context.lineCap = 'round';
        context.strokeStyle = 'black';

        context.lineTo(e.clientX - canvas.getBoundingClientRect().left, e.clientY - canvas.getBoundingClientRect().top);
        context.stroke();
        context.beginPath();
        context.moveTo(e.clientX - canvas.getBoundingClientRect().left, e.clientY - canvas.getBoundingClientRect().top);
    }

    function clearSignature() {
        context.clearRect(0, 0, canvas.width, canvas.height);
    }

    function saveSignature() {
        const signatureData = canvas.toDataURL('image/png');
        // You can send this data to your server or handle it as needed.
        console.log(signatureData);
    }
</script> --}}
</html>


@endsection
