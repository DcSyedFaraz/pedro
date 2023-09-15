@extends('admin.layouts.app')


@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Invoice</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Edit Invoice</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="container-fluid">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <form action="{{ route('invoice.update', $invoice->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="container mt-5">
                                                <div class="row">
                                                    <div class="col-md-6">&nbsp;</div>
                                                    <div class="col-md-6 d-flex justify-content-end">
                                                        <button type="submit" class="btn btn-primary">Save Invoice</button>
                                                    </div>
                                                </div>
                                                <ul class="nav nav-tabs">
                                                    <li class="nav-item">
                                                        <a class="nav-link active" data-toggle="tab"
                                                            href="#single-invoice">Single Invoice</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" data-toggle="tab"
                                                            href="#process-billing">Process
                                                            Billing</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" data-toggle="tab" href="#no-change">No
                                                            Change</a>
                                                    </li>
                                                </ul>
                                                <div class="tab-content mt-3">
                                                    <div id="single-invoice" class="tab-pane fade show active">
                                                        <ul class="nav nav-tabs mt-4">
                                                            <li class="nav-item">
                                                                <a class="nav-link active" data-toggle="tab"
                                                                    href="#products-services">Products & Services</a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link" data-toggle="tab"
                                                                    href="#drive-and-labor-times">Drive & Labor Times</a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link" data-toggle="tab"
                                                                    href="#expenses">Expenses</a>
                                                            </li>
                                                        </ul>
                                                        <div class="tab-content mt-3">

                                                            <div id="products-services" class="tab-pane fade show active">
                                                                @include('admin.job.partials.invoice')
                                                            </div>
                                                            <!--drive-and-labor-times  -->
                                                            <div id="drive-and-labor-times" class="tab-pane fade show">
                                                                @include('admin.job.partials.drive_and_labor_time')
                                                            </div>
                                                            <!-- expenses -->
                                                            <div id="expenses" class="tab-pane fade show">
                                                                @include('admin.job.partials.expense')
                                                            </div>
                                                        </div>
                                                        <br />
                                                        <div class="row w-25 d-flex flex-column">

                                                            <div class="col-md-12">
                                                                <strong>Status</strong>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">

                                                                    <select name="status" id="customer_id"
                                                                        class="form-control">
                                                                        <option value=""  selected hidden>Select Job
                                                                        </option>
                                                                        <option value="unpaid"  {{ old('status', isset($invoice) ? $invoice->status : '') == 'unpaid' ? 'selected' : '' }}>UnPaid
                                                                        </option>
                                                                        <option value="paid"  {{ old('status', isset($invoice) ? $invoice->status : '') == 'paid' ? 'selected' : '' }}>Paid
                                                                        </option>
                                                                        <option value="recurring"  {{ old('status', isset($invoice) ? $invoice->status : '') == 'recurring' ? 'selected' : '' }}>Recurring
                                                                        </option>

                                                                    </select>
                                                                    <span class="error-message error-messages"
                                                                        id="customer_id_error"></span><br>
                                                                </div>
                                                            </div>
                                                            <!-- <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <button class="form-control"><i class="fas fa-link"></i> Link to parent</button>
                                                                        </div>
                                                                    </div> -->
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label for="note-to-customer">Note To Customer</label>
                                                                <textarea id="note-to-customer" name="note_to_cust" class="form-control" rows="4">{{ old('note_to_cust', $invoice->note_to_cust) }}</textarea>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="row invoice">
                                                                    <div class="col">
                                                                        <p>Products, Services, Taxes & Fees</p>
                                                                        <p>Total Drive & Labor Time</p>
                                                                        <p>Total Billable Expenses</p>
                                                                        <p>Job Total</p>
                                                                        <p style="color:#09af2f">Payments/Deposits</p>
                                                                    </div>
                                                                    <div class="col">
                                                                        <!-- Add the following line with a unique ID -->
                                                                        <p><span
                                                                                id="job-product-and-service-taxes-and-fees">$0.00</span>
                                                                        </p>
                                                                        <p><span
                                                                                id="job-total-drive-and-labor-time">$0.00</span>
                                                                        </p>
                                                                        <p><span id="job-total-billing-expense">$0.00</span>
                                                                        </p>
                                                                        <p><span id="job-total-job-amount">$0.00</span></p>
                                                                        <p style="color:#09af2f"><span
                                                                                id="job_payments_and_deposits">$0.00</span>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="row mt-3 invoice">
                                                                    <div class="col">
                                                                        <p>Total Due</p>
                                                                        <p>Job Cost</p>
                                                                        <p>Gross Profit <span
                                                                                id="job-gross-profit-percentage">(0.00%)</span>
                                                                        </p>
                                                                    </div>
                                                                    <div class="col">
                                                                        <p><span id=""><input type="text"
                                                                                    id="job_total_due" disabled></span></p>
                                                                        <p><span id="job_total_cost">$0.00</span></p>
                                                                        <p style="color:#09af2f"><span
                                                                                id="job-gross-profit">$0.00</span></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Process Billing -->
                                                    <div id="process-billing" class="tab-pane fade show">
                                                        <h6>Process Billing</h6>
                                                    </div>
                                                    <!-- No Change -->
                                                    <div id="no-change" class="tab-pane fade show">
                                                        <h6>No Change</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- @include('admin.job.partials.invoice') -->
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
@endsection
