@extends(Auth::user()->hasRole('Admin') ? 'admin.layouts.app' :  'manager.layouts.app' )


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
                        <h1>New Purchase Order</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">New Purchase Order</li>
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
                                <form action="{{ route('purchase-orders.store') }}" method="POST">
                                    @csrf
                                    <div class="inner-section-2">
                                        <div class="container">
                                            <div class="row bordewer">
                                                <div class="col-sm-12">
                                                    <div class="inner-header bg-colored pt-2 pb-2">
                                                        <h4 class="primary">Purchase Order</h4>
                                                    </div>
                                                </div>
                                                <div class="innerinputs">
                                                    <div class="row">
                                                        <div class="col-lg-7">
                                                            <div class="row">
                                                                <div class="col-sm-4">
                                                                    <label for="exampleInputcustomer"
                                                                        class="form-label">Supplier</label>
                                                                    <select name="supplier" class="form-select form-control"
                                                                        aria-label="Default select example" id="vender-div">
                                                                        <option value="0" disabled selected hidden>
                                                                            Select a Supplier</option>
                                                                        <option value="1">Supplier 1</option>
                                                                        <option value="2">Supplier 2</option>
                                                                    </select>
                                                                </div>

                                                                <div class="col-sm-4">
                                                                    <div class="purchase-order-div">
                                                                        <label for="reference" class="form-label">Order
                                                                            Reference</label>
                                                                        <input name="order_ref" type="number"
                                                                            class="form-control" placeholder="1011"
                                                                            id="reference">

                                                                    </div>
                                                                </div>

                                                                <div class="col-sm-4">
                                                                    <label for="vender-div" class="form-label">Order
                                                                        Progress</label>
                                                                    <select name="order_progress"
                                                                        class="form-select form-control"
                                                                        aria-label="Default select example" id="vender-div">
                                                                        <option value="Open">Open</option>
                                                                        <option value="Close">Close</option>
                                                                    </select>
                                                                </div>

                                                                <div class="col-sm-4">
                                                                    <label for="vender-div" class="form-label">Payment Terms
                                                                    </label>
                                                                    <select name="payment_term"
                                                                        class="form-select form-control"
                                                                        aria-label="Default select example" id="vender-div">
                                                                        <option value="0" disabled selected hidden>Cash
                                                                            on Delivery</option>
                                                                        <option value="Paypal">Paypal</option>
                                                                        <option value="Stripe">Stripe</option>
                                                                    </select>

                                                                </div>

                                                                <div class="col-sm-4">
                                                                    <div class="form-group">
                                                                        <label for="reference" class="form-label">Order
                                                                            Date</label>
                                                                        <div class="input-group date" id="datepicker">
                                                                            <input name="order_date" type="date"
                                                                                class="form-control"
                                                                                placeholder="08/16/2023" id="date" />

                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-sm-4">
                                                                    <div class="purchase-order-status">
                                                                        <label for="vender-div" class="form-label">Sender of
                                                                            PO
                                                                        </label>
                                                                        <select name="sender"
                                                                            class="form-select form-control"
                                                                            aria-label="Default select example"
                                                                            id="vender-div">
                                                                            <option value="Not Sent">Not Sent</option>
                                                                            <option value="Self">Self</option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="col-sm-6">
                                                                    <div class="memo-main-div">
                                                                        <label for="reference" class="form-label">Memo ID
                                                                        </label>
                                                                        <input name="memo_id" type="number"
                                                                            class="form-control" id="reference">

                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <div class="shipping-method-div">
                                                                        <label for="shipping-method"
                                                                            class="form-label">Shipping Option
                                                                        </label>
                                                                        <input name="ship_option" type="text"
                                                                            class="form-control" id="shipping-method">

                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <div class="sent-on-div">
                                                                        <label for="sent-on" class="form-label">Sent Date
                                                                        </label>
                                                                        <input name="sent_date" type="date"
                                                                            class="form-control" id="sent-on">

                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="col-lg-5">
                                                            <div class="row">
                                                                <div class="col-sm-4">
                                                                    <label for="vender-div" class="form-label">Receipt
                                                                        Status
                                                                    </label>
                                                                    <select name="receipt_status"
                                                                        class="form-select form-control"
                                                                        aria-label="Default select example"
                                                                        id="vender-div">
                                                                        <option value="Not Received">Not Received</option>
                                                                        <option value="Received">Received</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <div class="purchase-order-div">
                                                                        <label for="reference" class="form-label">Direct
                                                                            Shipping
                                                                        </label>
                                                                        <input name="direct_shipping" type="text"
                                                                            class="form-control"
                                                                            placeholder="Search by name,phone,street,city or email"
                                                                            id="reference">
                                                                    </div>
                                                                </div>

                                                                <div class="col-12">
                                                                    <div class="shipping-address-div">
                                                                        <label for="reference"
                                                                            class="form-label">Recipient's Address
                                                                        </label>
                                                                        <div class="row">
                                                                            <div class="col-12">
                                                                                <input name="location" type="text"
                                                                                    class="form-control"
                                                                                    placeholder="Location Name (e.g Home or Office)"
                                                                                    id="location-name">
                                                                            </div>
                                                                            <div class="col-sm-8">
                                                                                <input name="street" type="text"
                                                                                    class="form-control"
                                                                                    placeholder="Street Address"
                                                                                    id="streetaddress">
                                                                            </div>
                                                                            <div class="col-sm-4">
                                                                                <input name="apt" type="text"
                                                                                    class="form-control"
                                                                                    placeholder="Ste/Unit/Apt"
                                                                                    id="steunitapt">
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <input name="tampa" type="text"
                                                                                    class="form-control"
                                                                                    placeholder="Tampa" id="steunitapt">
                                                                            </div>
                                                                            <div class="col-sm-4">
                                                                                <input name="fl" type="text"
                                                                                    class="form-control" placeholder="FL"
                                                                                    id="steunitapt">
                                                                            </div>
                                                                            <div class="col-sm-3">
                                                                                <input name="num" type="text"
                                                                                    class="form-control"
                                                                                    placeholder="33602" id="steunitapt">
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
                                                        <h4 class="primary">Item List</h4>
                                                    </div>
                                                </div>
                                                <div class="innerinputs">
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <div class="addproduct-div">
                                                                <label for="addproduct" class="form-label">Item Name
                                                                </label>
                                                                <input name="item_name" type="text"
                                                                    class="form-control" placeholder="Add Product"
                                                                    id="addproduct">

                                                            </div>
                                                        </div>

                                                        <div class="col-sm-1">
                                                            <div class="addproduct-div">
                                                                <label for="addproduct" class="form-label">Quantity
                                                                </label>
                                                                <input name="qty" type="number" class="form-control"
                                                                    id="addproduct">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="addproduct-div">
                                                                <label for="addproduct" class="form-label">Unit Price
                                                                </label>
                                                                <input name="unit_price" type="number"
                                                                    class="form-control" id="addproduct">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="addproduct-div">
                                                                <label for="addproduct" class="form-label">Total Amount
                                                                </label>
                                                                <input name="total" type="number" class="form-control"
                                                                    id="addproduct">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="addproduct-div">
                                                                <label for="addproduct" class="form-label">Job Assignment
                                                                </label>
                                                                <input name="job_assign" type="text"
                                                                    class="form-control" id="addproduct">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="addproduct-div">
                                                                <label for="addproduct" class="form-label">Receipt
                                                                </label>
                                                                <input name="receipt" type="text" class="form-control"
                                                                    id="addproduct">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- ///////////////////////// -->
                                                <div class="innerinputs-last">
                                                    <div class="row">
                                                        <div class="col-8">
                                                            <div class="message-main-div">
                                                                <label for="vender-div" class="form-label">Item
                                                                    Description
                                                                </label>
                                                                <textarea name="description" rows="5" cols="80"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-4 total-cost">
                                                            <div class="inner-inner-inner">
                                                                <h5>Subtotal</h5>
                                                                <input type="number" id="subtotal" name="subtotal"
                                                                    class="total" disabled value="0.00">
                                                            </div>
                                                            <div class="inner-inner-inner">
                                                                <h5 style="color:green;">Received Discount
                                                                    (-)</h5>
                                                                <input type="number" id="discount" name="discount"
                                                                    class="total" disabled value="0.00">
                                                            </div>
                                                            <div class="inner-inner-inner">
                                                                <h5>Tax Paid
                                                                </h5>
                                                                <input type="number" id="tax_paid" name="tax_paid"
                                                                    class="total" disabled value="0.00">
                                                            </div>
                                                            <div class="inner-inner-inner">
                                                                <h5>Shipping Cost
                                                                </h5>
                                                                <input type="number" id="ship_cost" name="ship_cost"
                                                                    class="total" disabled value="0.00">
                                                            </div>
                                                            <div class="inner-inner-inner">
                                                                <h5>Grand Total Price
                                                                </h5>
                                                                <input type="number" id="grand_total" name="grand_total"
                                                                    class="total" disabled value="0.00">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="inner-section-4">
                                        <div class="container">
                                            <div class="row">
                                                <input name="" type="submit" />
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </section>

    </div>
@endsection
