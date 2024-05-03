@extends(Auth::user()->hasRole('Admin') ? 'admin.layouts.app' : (Auth::user()->hasRole('vendor') ? 'vendor.layouts.app' : (Auth::user()->hasRole('account manager') ? 'manager.layouts.app' : (Auth::user()->hasRole('User') ? 'users.layouts.app': 'default.app'))))


@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ __('user/supply/index.supply_request') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">{{ __('user/supply/index.supply_request') }}</li>
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
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>{{ __('user/supply/index.field') }}</th>
                                    <th>{{ __('user/supply/index.value') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ __('user/supply/index.order_progress') }}</td>
                                    <td>{{ $supplyRequest->order_progress }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('user/supply/index.order_date') }}</td>
                                    <td>{{ $supplyRequest->order_date }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('user/supply/index.po') }}#</td>
                                    <td>{{ $supplyRequest->po_num }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('user/supply/index.account_managers_email') }}</td>
                                    <td>{{ $supplyRequest->manager_email }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('user/supply/index.sent_date') }}</</td>
                                    <td>{{ $supplyRequest->sent_date }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('user/supply/index.receipt_status') }}</</td>
                                    <td>{{ $supplyRequest->receipt_status }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.row -->
            </div>
        </section>
    </div>


    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
@endsection
