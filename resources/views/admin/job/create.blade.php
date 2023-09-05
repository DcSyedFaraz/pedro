@extends('admin.layouts.app')

@section('content')
<style>
a {
    color: #5c5555;
    text-decoration: none;
    background-color: transparent;
}

.circle {
    position: relative;
    display: inline-block;
    width: 19px;
    height: 19px;
    border-radius: 50%;
    background-color: #f39c12;
    color: #fff;
    font-size: 12px;
    text-align: center;
    line-height: 20px;
}
.error {
    border: 1px solid #f39c12;
}

.error-message {
color: #f39c12;
}
.error-messages{
font-size: 14px;
color: #f39c12;
}

.invoice {
    background: #e5e3e3;
    border-radius: 2px;
    font-weight: bold;
}
th {
    position: relative;
    padding-left: 20px;
}
.group-button {
    background-color: #ece9e9;
    border-color: #ccc;
    color: #000;
}

	.nav-tabs  li a {
		font-size: 14px;
	}

</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
<section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1>Create New Jobs</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active">Create New Jobs</li>
                                </ol>
                            </div>
                        </div>
                    </div>
    <!-- /.container-fluid -->
</section>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <form id="myForm" action="{{route('job.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">&nbsp;</div>
                        <div class="col-md-6 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Save Job</button>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-6">
                            <!-- tabs A -->
                            <ul class="nav nav-tabs justify-content-end" id="jobDetTabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="sum-tab" data-toggle="tab" href="#sum" role="tab" aria-controls="sum" aria-selected="true"><i class="fas fa-list-alt fa-fw"></i> Summary</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="cut-tab" data-toggle="tab" href="#cut" role="tab" aria-controls="cut" aria-selected="false"><i class="fas fa-columns fa-fw"></i> Customer Flds</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pic-tab" data-toggle="tab" href="#pic" role="tab" aria-controls="pic" aria-selected="false"><i class="fas fa-image fa-fw"></i> Pics&nbsp;<span class="circle">{{ isset($job_img) ? $job_img : 0 }}</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="doc-tab" data-toggle="tab" href="#doc" role="tab" aria-controls="doc" aria-selected="false"><i class="fas fa-file fa-fw"></i> Docs&nbsp;<span class="circle">{{ isset($job_doc) ? $job_doc : 0 }}</span></a>
                                </li>
                            </ul>
                            <div class="card">
                                <div class="card-header">
                                <div class="tab-content" id="jobTabsContent">
                                    <div class="tab-pane fade show active" id="sum" role="tabpanel" aria-labelledby="sum-tab">
                                        @include('admin.job.partials.summary')
                                    </div>
                                    <div class="tab-pane fade" id="cut" role="tabpanel" aria-labelledby="cut-tab">
                                        @include('admin.job.partials.customer_fields')
                                    </div>
                                    <div class="tab-pane fade show" id="pic" role="tabpanel" aria-labelledby="pic-tab">
                                        @include('admin.job.partials.picture')
                                    </div>
                                    <div class="tab-pane fade" id="doc" role="tabpanel" aria-labelledby="doc-tab">
                                        @include('admin.job.partials.ducoments')
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <!-- tabs B -->
                            <ul class="nav nav-tabs justify-content-end" id="jobInfoTabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="info-tab" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="true"><i class="fas fa-calendar fa-fw"></i> Scheduling</a>
                                </li>
                            </ul>
                            <div class="card">
                                <div class="card-header">
                                    <div class="tab-content" id="jobTabsContent">
                                        <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="info-tab">
                                            @include('admin.job.partials.job_scheduling')
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--invoice Start  -->
                    {{-- <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-12">
                                <div class="container mt-5">
                                        <ul class="nav nav-tabs">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-toggle="tab" href="#single-invoice">Single Invoice</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#process-billing">Process Billing</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#no-change">No Change</a>
                                            </li>
                                        </ul>
                                    <div class="tab-content mt-3">
                                        <div id="single-invoice" class="tab-pane fade show active">
                                            <ul class="nav nav-tabs mt-4">
                                                <li class="nav-item">
                                                    <a class="nav-link active" data-toggle="tab" href="#products-services">Products & Services</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="tab" href="#drive-and-labor-times">Drive & Labor Times</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="tab" href="#expenses">Expenses</a>
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
                                            <br/>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="note-to-customer">Note To Customer</label>
                                                    <textarea id="note-to-customer" name="note_to_cust" class="form-control" rows="4"></textarea>
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
                                                            <p><span id="job-product-and-service-taxes-and-fees">$0.00</span></p>
                                                            <p><span id="job-total-drive-and-labor-time">$0.00</span></p>
                                                            <p><span id="job-total-billing-expense">$0.00</span></p>
                                                            <p><span id="job-total-job-amount">$0.00</span></p>
                                                            <p style="color:#09af2f"><span id="job_payments_and_deposits">$0.00</span></p>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-3 invoice">
                                                        <div class="col">
                                                            <p>Total Due</p>
                                                            <p>Job Cost</p>
                                                            <p>Gross Profit <span id="job-gross-profit-percentage">(0.00%)</span></p>
                                                        </div>
                                                        <div class="col">
                                                            <p><span id="job_total_due">$0.00</span></p>
                                                            <p><span id="job_total_cost">$0.00</span></p>
                                                            <p style="color:#09af2f"><span id="job-gross-profit">$0.00</span></p>
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
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <!-- End Invoice End -->
                </form>
            </div>
        </div>
    </div>

</section>

</div>

@endsection
