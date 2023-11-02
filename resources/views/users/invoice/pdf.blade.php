<!DOCTYPE html>
<html lang="en">

<head>
    {{-- <style>
        .col-md-12.bg-primary.rounded-lg.text-center {
            background-color: #007bff;
            border-radius: 1rem;
            text-align: center;
        }

        .col-md-6 {
            /* You can add your custom styles for the columns here */
        }

        .card.card-primary {
            border: 1px solid #eee;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            margin-bottom: 20px;
            padding: 15px;
        }

        .card-body {
            padding: 1.25rem;
        }

        .list-group {
            display: flex;
            flex-direction: column;
            margin-bottom: 0;
            padding-left: 0;
            list-style: none;
        }

        .list-group-item {
            border: 1px solid #eee;
            margin-bottom: -1px;
            padding: 10px;
            background-color: #fff;
        }

        .badge {
            display: inline-block;
            padding: 0.25em 0.4em;
            font-size: 75%;
            font-weight: 700;
            line-height: 1;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: 0.25rem;
        }

        .badge-danger {
            color: #fff;
            background-color: #dc3545;
        }

        .badge-success {
            color: #fff;
            background-color: #28a745;
        }

        .badge-warning {
            color: #212529;
            background-color: #ffc107;
        }

        /* Bootstrap classes */
        .bg-primary {
            background-color: #007bff;
        }

        .rounded-lg {
            border-radius: 1rem;
        }

        .text-center {
            text-align: center;
        }

        .card {
            border: 1px solid #eee;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            margin-bottom: 20px;
            padding: 15px;
        }

        .card-body {
            padding: 1.25rem;
        }

        .list-group {
            display: flex;
            flex-direction: column;
            margin-bottom: 0;
            padding-left: 0;
            list-style: none;
        }

        .list-group-item {
            border: 1px solid #eee;
            margin-bottom: -1px;
            padding: 10px;
            background-color: #fff;
        }

        .badge {
            display: inline-block;
            padding: 0.25em 0.4em;
            font-size: 75%;
            font-weight: 700;
            line-height: 1;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: 0.25rem;
        }

        .badge-danger {
            color: #fff;
            background-color: #dc3545;
        }

        .badge-success {
            color: #fff;
            background-color: #28a745;
        }

        .badge-warning {
            color: #212529;
            background-color: #ffc107;
        }

        /* Vanilla CSS */
        body {
            background-color: #007bff;
        }

        .rounded-lg {
            border-radius: 1rem;
        }

        .text-center {
            text-align: center;
        }

        .card {
            border: 1px solid #eee;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            margin-bottom: 20px;
            padding: 15px;
        }

        .card-body {
            padding: 1.25rem;
        }

        .list-group {
            display: flex;
            flex-direction: column;
            margin-bottom: 0;
            padding-left: 0;
            list-style: none;
        }

        .list-group-item {
            border: 1px solid #eee;
            margin-bottom: -1px;
            padding: 10px;
            background-color: #fff;
        }

        .badge {
            display: inline-block;
            padding: 0.25em 0.4em;
            font-size: 75%;
            font-weight: 700;
            line-height: 1;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: 0.25rem;
        }

        .badge-danger {
            color: #fff;
            background-color: #dc3545;
        }

        .badge-success {
            color: #fff;
            background-color: #28a745;
        }

        .badge-warning {
            color: #212529;
            background-color: #ffc107;
        }
    </style> --}}

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        {{-- <section class="content-header">
        <h1>Invoice Details</h1>
    </section> --}}

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
                                @foreach ($invoice->service as $invoices)
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
                                        <span
                                            class="badge badge-{{ $invoice->status === 'unpaid' ? 'danger' : ($invoice->status === 'paid' ? 'success' : 'warning') }}">{{ Str::ucfirst($invoice->status) }}</span>
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
                                </ul>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="m-4">
                    <button class="btn btn-primary" onclick="goBack()">Go Back</button>
                </div> --}}
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
</body>

</html>
