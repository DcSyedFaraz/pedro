@extends(Auth::user()->hasRole('Admin') ? 'admin.layouts.app' : 'manager.layouts.app')


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

        .error-messages {
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

        .nav-tabs li a {
            font-size: 14px;
        }
    </style>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Create New Estimates</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Create New Estimates</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <form id="myForm" action="{{ route('estimates.store') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">&nbsp;</div>
                                <div class="col-md-6 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                            </br>
                            <div class="row">
                                <div class="col-6">
                                    <!-- tabs A -->
                                    <ul class="nav nav-tabs justify-content-end" id="jobDetTabs" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="sum-tab" data-toggle="tab" href="#sum"
                                                role="tab" aria-controls="sum" aria-selected="true"><i
                                                    class="fas fa-list-alt fa-fw"></i> Summary</a>
                                        </li>
                                        {{-- <li class="nav-item">
                                            <a class="nav-link" id="cut-tab" data-toggle="tab" href="#cut"
                                                role="tab" aria-controls="cut" aria-selected="false"><i
                                                    class="fas fa-columns fa-fw"></i> Customer Flds</a>
                                        </li> --}}
                                        <li class="nav-item">
                                            <a class="nav-link" id="pic-tab" data-toggle="tab" href="#pic"
                                                role="tab" aria-controls="pic" aria-selected="false"><i
                                                    class="fas fa-image fa-fw"></i> Pics&nbsp;<span
                                                    class="circle">{{ isset($job_img) ? $job_img : 0 }}</span></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="doc-tab" data-toggle="tab" href="#doc"
                                                role="tab" aria-controls="doc" aria-selected="false"><i
                                                    class="fas fa-file fa-fw"></i> Docs&nbsp;<span
                                                    class="circle">{{ isset($job_doc) ? $job_doc : 0 }}</span></a>
                                        </li>
                                    </ul>
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="tab-content" id="jobTabsContent">
                                                <div class="tab-pane fade show active" id="sum" role="tabpanel"
                                                    aria-labelledby="sum-tab">
                                                    @include('admin.estimates.partials.summary')
                                                </div>
                                                {{-- <div class="tab-pane fade" id="cut" role="tabpanel"
                                                    aria-labelledby="cut-tab">
                                                    @include('admin.estimates.partials.customer_fields')
                                                </div> --}}
                                                <div class="tab-pane fade show" id="pic" role="tabpanel"
                                                    aria-labelledby="pic-tab">
                                                    @include('admin.estimates.partials.picture')
                                                </div>
                                                <div class="tab-pane fade" id="doc" role="tabpanel"
                                                    aria-labelledby="doc-tab">
                                                    @include('admin.estimates.partials.ducoments')
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <!-- tabs B -->
                                    <ul class="nav nav-tabs justify-content-end" id="jobInfoTabs" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="info-tab" data-toggle="tab" href="#info"
                                                role="tab" aria-controls="info" aria-selected="true"><i
                                                    class="fas fa-calendar fa-fw"></i> Scheduling</a>
                                        </li>
                                    </ul>
                                    <div class="card">
                                        <div class="card-header" style="margin: 0px 0px 92px 1px;">
                                            <div class="tab-content" id="jobTabsContent">
                                                <div class="tab-pane fade show active" id="info" role="tabpanel"
                                                    aria-labelledby="info-tab">
                                                    @include('admin.estimates.partials.job_scheduling')
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--invoice Start  -->
                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="container mt-5">
                                                <div class="tab-content mt-3">
                                                    <div id="single-invoice" class="tab-pane fade show active">
                                                        <ul class="nav nav-tabs mt-4">
                                                            <li class="nav-item">
                                                                <a class="nav-link active" data-toggle="tab"
                                                                    href="#products-services">Estimate</a>
                                                            </li>
                                                        </ul>
                                                        <div class="tab-content mt-3">
                                                            <div id="products-services" class="tab-pane fade show active">
                                                                <x-invoice-service-table :route="'#'" />
                                                                {{-- @include('admin.estimates.partials.invoice') --}}
                                                            </div>
                                                        </div>
                                                        <br />
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label for="note-to-customer">Note To Customer</label>
                                                                <textarea id="note-to-customer" name="note_to_cust" class="form-control" rows="4">{{ isset($estimate->note_to_cust) ? old('note_to_cust', $estimate->note_to_cust) : '' }}</textarea>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="row mt-3 invoice">
                                                                    <div class="col">
                                                                        <p>Estimates Total</p>
                                                                        <p>Job Cost</p>
                                                                        <p>Gross Profit <span
                                                                                id="est-gross-profit-percentage">(0.00%)</span>
                                                                        </p>
                                                                    </div>
                                                                    <div class="col">
                                                                        <p><span
                                                                                id="est-product-and-service-taxes-and-fees">$0.00</span>
                                                                        </p>
                                                                        <p><span id="est_total_cost">$0.00</span></p>
                                                                        <p style="color:#09af2f"><span
                                                                                id="est-gross-profit">$0.00</span></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Invoice End -->
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
