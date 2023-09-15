@extends('admin.layouts.app')

@section('content')
    <style>
        a {
            color: #5c5555;
            text-decoration: none;
            background-color: transparent;
        }
    </style>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Invoice Dashboard</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Invoice Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-10 border-2 border">
                        <!-- tabs A -->
                        <ul class="nav nav-tabs justify-content-end" id="jobDetTabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="sum-tab" data-toggle="tab" href="#sum" role="tab"
                                    aria-controls="sum" aria-selected="true"><i class="fas fa-exclamation-circle text-danger"></i>

                                    Unpaid Invoices</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="cut-tab" data-toggle="tab" href="#cut" role="tab"
                                    aria-controls="cut" aria-selected="false"><i class="fas fa-check-circle text-success"></i>
                                    Paid Invoices</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pic-tab" data-toggle="tab" href="#pic" role="tab"
                                    aria-controls="pic" aria-selected="false"><i class="fas fa-recycle  text-warning"></i>

                                    Recurring&nbsp;</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="doc-tab" data-toggle="tab" href="#doc" role="tab"
                                    aria-controls="doc" aria-selected="false"><i class="fas fa-list text-info"></i>

                                    All Invoices&nbsp;</a>
                            </li>
                        </ul>
                        <div class="card">
                            <div class="card-header">
                                <div class="tab-content" id="jobTabsContent">
                                    <div class="tab-pane fade show active" id="sum" role="tabpanel"
                                        aria-labelledby="sum-tab">
                                        @include('admin.invoice.partials.unpaid')
                                    </div>
                                    <div class="tab-pane fade" id="cut" role="tabpanel" aria-labelledby="cut-tab">
                                        @include('admin.invoice.partials.paid')
                                    </div>
                                    <div class="tab-pane fade show" id="pic" role="tabpanel"
                                        aria-labelledby="pic-tab">
                                        @include('admin.invoice.partials.recurring')
                                    </div>
                                    <div class="tab-pane fade" id="doc" role="tabpanel" aria-labelledby="doc-tab">
                                        @include('admin.invoice.partials.all')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="card">
                            <div class="card-body text-center">
                                Past Due
                                <div class="mt-2">
                                    <i class="fas fa-clock text-danger text-xl"></i>
                                    <span class="text-bold mb-3">{{ isset($add) ? $add : 'N/A' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body text-center">
                                Total Bill
                                <div class="mt-2">
                                    <i class="fas fa-dollar-sign text-warning text-xl"></i>
                                    <span class="text-bold mb-3">{{ isset($add) ? $add : 'N/A' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>


    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
@endsection
