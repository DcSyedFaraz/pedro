@extends(Auth::user()->hasRole('Admin') ? 'admin.layouts.app' : (Auth::user()->hasRole('vendor') ? 'vendor.layouts.app' : (Auth::user()->hasRole('account manager') ? 'manager.layouts.app' : 'default.layout'))) {{-- Include your base layout if you have one --}}

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Invoice Details</h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Your content goes here -->

            <div class="col-md-12 bg-primary rounded-lg text-center ">
                <h3 class="">Invoice Information</h3>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">

                        <div class="card-body">
                            @foreach ($invoice->service as $invoices )
                            <ul class="list-group">

                                <li class="list-group-item">
                                    <strong>Description:</strong>
                                    <span>{{ $invoices->description }}</span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Warehouse:</strong>
                                    <span>{{ $invoices->warehouse }}</span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Quantity/Hours:</strong>
                                    <span>{{ $invoices->qty_hrs }}</span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Rate:</strong>
                                    <span>{{ $invoices->rate }}</span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Total:</strong>
                                    <span>{{ $invoices->total }}</span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Cost:</strong>
                                    <span>{{ $invoices->cost }}</span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Margin Tax:</strong>
                                    <span>{{ $invoices->margin_tax }}</span>
                                </li>
                                <br>

                            </ul>
                                @endforeach

                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-primary">

                        <div class="card-body">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <strong>Job ID:</strong>
                                    <span>{{ $invoice->job_id }}</span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Status:</strong>
                                    <span class="badge badge-{{ $invoice->status === 'unpaid' ? 'danger' : ($invoice->status === 'paid' ? 'success' : 'warning') }}">{{ Str::ucfirst($invoice->status) }}</span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Drive Time:</strong>
                                    <span>{{ $invoice->drive_time }}</span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Labor Time:</strong>
                                    <span>{{ $invoice->labor_time }}</span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Payments and Deposits Input:</strong>
                                    <span>{{ $invoice->payments_and_deposits_input }}</span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Amount Description:</strong>
                                    <span>{{ $invoice->amount_description }}</span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Amount:</strong>
                                    <span>{{ $invoice->amount }}</span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Note to Customer:</strong>
                                    <span>{{ $invoice->note_to_cust }}</span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Created By:</strong>
                                    <span>{{ $invoice->user->name ?? 'N/A' }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="m-4">
                    <button class="btn btn-primary" onclick="goBack()">Go Back</button>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<script>
    function goBack() {
        window.history.back();
    }
</script>
<!-- /.content-wrapper -->
@endsection
