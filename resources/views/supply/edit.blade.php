@extends(Auth::user()->hasRole('Admin') ? 'admin.layouts.app' : (Auth::user()->hasRole('vendor') ? 'vendor.layouts.app' : (Auth::user()->hasRole('account manager') ? 'manager.layouts.app' : (Auth::user()->hasRole('User') ? 'users.layouts.app': 'default.app'))))

<style>
    label {
        display: inline-block;
        margin-bottom: 0.5rem;
        margin-top: 18px;
    }
</style>
@section('content')
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

        <section class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <form action="{{ route('supply.update', $supplyRequest->id) }}" method="POST">
                                    @csrf
                                    @method('PUT') <!-- Use PUT method for updating -->
                                    <div class="inner-section-2">
                                        <div class="container">
                                            <div class="row bordewer">
                                                <div class="col-sm-12">
                                                    <div class="inner-header bg-colored pt-2 pb-2">
                                                        <h4 class="primary">{{ __('user/supply/index.supply_request') }}</h4>
                                                    </div>
                                                </div>
                                                <div class="innerinputs">
                                                    <div class="row">
                                                        <!-- 'order_progress' field -->
                                                        <div class="col-lg-7">
                                                            <div class="row">
                                                                <div class="col-sm-4">
                                                                    <label for="vender-div" class="form-label">{{ __('user/supply/index.order_progress') }}</label>
                                                                    <select name="order_progress"
                                                                        class="form-select form-control"
                                                                        aria-label="Default select example" id="vender-div">
                                                                        <option value="Open"
                                                                            {{ old('order_progress', $supplyRequest->order_progress) == 'Open' ? 'selected' : '' }}>
                                                                            Open</option>
                                                                        <option value="Close"
                                                                            {{ old('order_progress', $supplyRequest->order_progress) == 'Close' ? 'selected' : '' }}>
                                                                            Close</option>
                                                                    </select>
                                                                </div>
                                                                <!-- Repeat the above block for other fields -->

                                                                <!-- 'order_date' field -->
                                                                <div class="col-sm-4">
                                                                    <div class="form-group">
                                                                        <label for="order_date" class="form-label">{{ __('user/supply/index.order_date') }}</label>
                                                                        <div class="input-group date" id="datepicker">
                                                                            <input name="order_date" type="date"
                                                                                class="form-control" id="order_date"
                                                                                value="{{ old('order_date', $supplyRequest->order_date) }}" />
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <!-- 'po_num' field -->
                                                                <div class="col-sm-4">
                                                                    <div class="purchase-order-status">
                                                                        <label for="po_num" class="form-label">{{ __('user/supply/index.po') }}</label>
                                                                        <input name="po_num" type="number"
                                                                            class="form-control" id="po_num"
                                                                            value="{{ old('po_num', $supplyRequest->po_num) }}">
                                                                    </div>
                                                                </div>

                                                                <!-- 'manager_email' field -->
                                                                <div class="col-sm-6">
                                                                    <div class="memo-main-div">
                                                                        <label for="manager_email"
                                                                            class="form-label">{{ __('user/supply/index.account_managers_email') }}</label>
                                                                        <input name="manager_email" type="email"
                                                                            class="form-control" id="manager_email"
                                                                            value="{{ old('manager_email', $supplyRequest->manager_email) }}">
                                                                    </div>
                                                                </div>

                                                                <!-- 'sent_date' field -->
                                                                <div class="col-sm-3">
                                                                    <div class="sent-on-div">
                                                                        <label for="sent_date" class="form-label">{{ __('user/supply/index.sent_date') }}</label>
                                                                        <input name="sent_date" type="date"
                                                                            class="form-control" id="sent_date"
                                                                            value="{{ old('sent_date', $supplyRequest->sent_date) }}">
                                                                    </div>
                                                                </div>

                                                                <!-- 'receipt_status' field -->
                                                                <div class="col-sm-3">
                                                                    <label for="receipt_status" class="form-label">{{ __('user/supply/index.receipt_status') }}</label>
                                                                    <select name="receipt_status"
                                                                        class="form-select form-control"
                                                                        aria-label="Default select example"
                                                                        id="receipt_status">
                                                                        <option value="Not Received"
                                                                            {{ old('receipt_status', $supplyRequest->receipt_status) == 'Not Received' ? 'selected' : '' }}>
                                                                            Not Received</option>
                                                                        <option value="Received"
                                                                            {{ old('receipt_status', $supplyRequest->receipt_status) == 'Received' ? 'selected' : '' }}>
                                                                            Received</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- 'location' field -->
                                                        <div class="col-lg-5">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="shipping-address-div">
                                                                        <label for="location" class="form-label">Service
                                                                            Location</label>
                                                                        <div class="row">
                                                                            <div class="col-12">
                                                                                <input name="location" type="text"
                                                                                    class="form-control"
                                                                                    placeholder="Location Name (e.g Home or Office)"
                                                                                    id="location-name"
                                                                                    value="{{ old('location', $supplyRequest->location) }}">
                                                                            </div>
                                                                            <div class="col-sm-8">
                                                                                <input name="street" type="text"
                                                                                    class="form-control"
                                                                                    placeholder="Street Address"
                                                                                    id="streetaddress"
                                                                                    value="{{ old('street', $supplyRequest->street) }}">
                                                                            </div>
                                                                            <div class="col-sm-4">
                                                                                <input name="apt" type="text"
                                                                                    class="form-control"
                                                                                    placeholder="Ste/Unit/Apt"
                                                                                    id="steunitapt"
                                                                                    value="{{ old('apt', $supplyRequest->apt) }}">
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <input name="tampa" type="text"
                                                                                    class="form-control"
                                                                                    placeholder="Tampa" id="tampa"
                                                                                    value="{{ old('tampa', $supplyRequest->tampa) }}">
                                                                            </div>
                                                                            <div class="col-sm-4">
                                                                                <input name="fl" type="text"
                                                                                    class="form-control" placeholder="FL"
                                                                                    id="fl"
                                                                                    value="{{ old('fl', $supplyRequest->fl) }}">
                                                                            </div>
                                                                            <div class="col-sm-3">
                                                                                <input name="num" type="text"
                                                                                    class="form-control"
                                                                                    placeholder="33602" id="num"
                                                                                    value="{{ old('num', $supplyRequest->num) }}">
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
                                    <div class="inner-section-3">
                                        <div class="container">
                                            <div class="row bordewer">
                                                <div class="col-sm-12">
                                                    <div class="inner-header bg-colored pt-2 pb-2">
                                                        <h4 class="primary">{{ __('user/supply/index.item_date') }}</h4>
                                                    </div>
                                                </div>
                                                <div class="innerinputs">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <div class="addproduct-div">
                                                                <label for="addproduct" class="form-label">{{ __('user/supply/index.item_name') }}</label>
                                                                <input name="item_name" type="text"
                                                                    class="form-control" placeholder="Add Product"
                                                                    id="addproduct"
                                                                    value="{{ old('item_name', $supplyRequest->item_name) }}">
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-4">
                                                            <div class="addproduct-div">
                                                                <label for="addproduct"
                                                                    class="form-label">{{ __('user/supply/index.quantity') }}</label>
                                                                <input name="qty" type="number" class="form-control"
                                                                    id="addproduct"
                                                                    value="{{ old('qty', $supplyRequest->qty) }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="addproduct-div">
                                                                <label for="addproduct" class="form-label">{{ __('user/supply/index.job_assignment') }}
                                                                </label>
                                                                <input name="job_assign" type="text"
                                                                    class="form-control" id="addproduct" value="{{ old('job_assign', $supplyRequest->job_assign) }}">
                                                            </div>
                                                        </div>


                                                    </div>
                                                </div>
                                                <!-- ///////////////////////// -->
                                                <div class="innerinputs-last">
                                                    <div class="row">
                                                        <div class="col-8">
                                                            <div class="message-main-div">
                                                                <label for="description" class="form-label">{{ __('user/supply/index.item_description') }}n</label>
                                                                <textarea name="description" rows="5" cols="126">{{ old('description', $supplyRequest->description) }}</textarea>
                                                            </div>
                                                        </div>
                                                        <!-- Repeat the above block for other fields -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="inner-section-4">
                                        <div class="container">
                                            <div class="row">
                                                <input type="submit" value="Update" />
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
