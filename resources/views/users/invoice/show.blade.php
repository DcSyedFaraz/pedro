@extends('users.layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>{{ __('user/invoice/show.invoice_details') }}</h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Your content goes here -->

                <div class="col-md-12 bg-primary rounded-lg text-center ">
                    <h3 class="">{{ __('user/invoice/show.invoice_information') }}</h3>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-primary">

                            <div class="card-body">
                                @foreach ($invoice->service as $invoices)
                                    <ul class="list-group">

                                        <li class="list-group-item">
                                            <strong>{{ __('user/invoice/show.description') }}:</strong>
                                            <span>{{ $invoices->description }}</span>
                                        </li>
                                        <li class="list-group-item">
                                            <strong>{{ __('user/invoice/show.warehouse') }}:</strong>
                                            <span>{{ $invoices->warehouse }}</span>
                                        </li>
                                        <li class="list-group-item">
                                            <strong>{{ __('user/invoice/show.quantity_hours') }}:</strong>
                                            <span>{{ $invoices->qty_hrs }}</span>
                                        </li>
                                        <li class="list-group-item">
                                            <strong>{{ __('user/invoice/show.rate') }}:</strong>
                                            <span>{{ $invoices->rate }}</span>
                                        </li>
                                        <li class="list-group-item">
                                            <strong>{{ __('user/invoice/show.total') }}:</strong>
                                            <span>{{ $invoices->total }}</span>
                                        </li>
                                        <li class="list-group-item">
                                            <strong>{{ __('user/invoice/show.cost') }}:</strong>
                                            <span>{{ $invoices->cost }}</span>
                                        </li>
                                        <li class="list-group-item">
                                            <strong>{{ __('user/invoice/show.margin_tax') }}:</strong>
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

                            <divclass="card-body">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <strong>{{ __('user/invoice/show.job_id') }}:</strong>
                                    <span>{{ $invoice->job_id }}</span>
                                </li>
                                <li class="list-group-item">
                                    <strong>{{ __('user/invoice/show.status') }}:</strong>
                                    <span
                                        class="badge badge-{{ $invoice->status === 'unpaid' ? 'danger' : ($invoice->status === 'paid' ? 'success' : 'warning') }}">{{ Str::ucfirst($invoice->status) }}</span>
                                </li>
                                <li class="list-group-item">
                                    <strong>{{ __('user/invoice/show.drive_time') }}:</strong>
                                    <span>{{ $invoice->drive_time }}</span>
                                </li>
                                <li class="list-group-item">
                                    <strong>{{ __('user/invoice/show.labor_time') }}:</strong>
                                    <span>{{ $invoice->labor_time }}</span>
                                </li>
                                <li class="list-group-item">
                                    <strong>{{ __('user/invoice/show.payments_and_deposits_input') }}:</strong>
                                    <span>{{ $invoice->payments_and_deposits_input }}</span>
                                </li>
                                <li class="list-group-item">
                                    <strong>{{ __('user/invoice/show.amount_description') }}:</strong>
                                    <span>{{ $invoice->amount_description }}</span>
                                </li>
                                <li class="list-group-item">
                                    <strong>{{ __('user/invoice/show.amount') }}:</strong>
                                    <span>{{ $invoice->amount }}</span>
                                </li>
                                <li class="list-group-item">
                                    <strong>{{ __('user/invoice/show.note_to_customer') }}:</strong>
                                    <span>{{ $invoice->note_to_cust }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="m-4">
                    <button class="btn btn-primary" onclick="goBack()">{{ __('user/invoice/show.go_back') }}</button>
                    <a href="{{ route('invoice.generate', $invoice->id) }}"
                        class="btn btn-warning">{{ __('user/invoice/show.download_pdf') }}</a>
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
