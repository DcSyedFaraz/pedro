@extends('admin.layouts.app')


@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Create Inventory</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Create Inventory</li>
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
                                <form action="{{ route('inventory.store') }}" method="POST">
                                    @csrf
                                    <div class="inner-section-2">
                                        <div class="container">
                                            <div class="row bordewer">
                                                <div class="col-sm-12">
                                                    <div class="inner-header bg-colored pt-2 pb-2">
                                                        <h4 class="primary">Order Summary</h4>
                                                    </div>
                                                </div>
                                                <div class="innerinputs">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label for="vender-div" class="form-label">Vender</label>
                                                            <select name="vendor" class="form-select form-control"
                                                                aria-label="Default select example" id="vender-div">
                                                                <option value="0" disabled selected hidden>Select a
                                                                    Vendor</option>
                                                                <option value="Vendor 1">Vendor 1</option>
                                                                <option value="Vendor 2">Vendor 2</option>
                                                            </select>

                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="form-group">
                                                                <label for="vender-div" class="form-label">Date</label>
                                                                <div class="input-group date" id="datepicker">
                                                                    <input name="date" type="date"
                                                                        class="form-control" id="date" />

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <label for="vender-div" class="form-label">Paid For
                                                                    By</label>
                                                                <select name="paid_for" class="form-select form-control"
                                                                    aria-label="Default select example" id="vender-div">
                                                                    <option value="0" disabled selected hidden>Check /
                                                                        ACH</option>
                                                                    <option value="Paypal">Paypal</option>
                                                                    <option value="Stripe">Stripe</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3">

                                                            <label for="vender-div" class="form-label">Paid For By</label>
                                                            <input name="paid" type="number" class="form-control"
                                                                id="reference" placeholder="Paid">
                                                            </select>
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
                                                        <div class="col-sm-12">
                                                            <label for="receivedto" class="form-label">Received to: </label>
                                                            <input name="receive" type="text" class="form-control"
                                                                id="receivedto" placeholder="Received" />

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="innerinputs-last">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <div class="product-main-div">
                                                                <label for="receivedto" class="form-label">Product </label>
                                                                <select name="product" class="form-select form-control"
                                                                    aria-label="Default select example" id="product-div">
                                                                    <option value="0" disabled selected hidden>Select a
                                                                        Product</option>
                                                                    <option value="1">Product 1</option>
                                                                    <option value="2">Product 2</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="order-qty-main-div">
                                                                <label for="order-qty" class="form-label">Order Qty</label>
                                                                <input name="quantity" type="number" class="form-control"
                                                                    id="order-qty" placeholder="0.00">
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="unreceived-qty-main-div">
                                                                <label for="unreceived-qty" class="form-label">Unreceived
                                                                    Qty</label>
                                                                <input name="unreceived" type="number"
                                                                    class="form-control" id="unreceived-qty"
                                                                    placeholder="0.00">
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="unit-cost-main-div">
                                                                <label for="unit-cost" class="form-label">Per Unit
                                                                    Cost</label>
                                                                <input name="unit_cost" type="number"
                                                                    class="form-control" placeholder="0.00"
                                                                    id="unit-cost">
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="total-cost-main-div">
                                                                <label for="total-cost" class="form-label">Total
                                                                    Cost</label>
                                                                <input name="total" type="number" class="form-control"
                                                                    placeholder="0.00" id="total-cost">
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-8">

                                                        </div>
                                                        <div class="col-4 total-cost">
                                                            <div class="inner-inner-inner">
                                                                <h5>ITEM SUB TOTAL</h5>
                                                                <input type="number" id="subtotal" name="subtotal"
                                                                    class="total" disabled value="0.00">
                                                            </div>
                                                            <div class="inner-inner-inner">
                                                                <h5 style="color:green;">DISCOUNT RECIEVE (-)</h5>
                                                                <input type="number" id="discount" name="discount"
                                                                    class="total" disabled value="0.00">
                                                            </div>
                                                            <div class="inner-inner-inner">
                                                                <h5>SALES TAX PAID</h5>
                                                                <input type="number" id="tax_paid" name="tax_paid"
                                                                    class="total" disabled value="0.00">
                                                            </div>
                                                            <div class="inner-inner-inner">
                                                                <h5>SHIPPING/FREIGHT PAID</h5>
                                                                <input type="number" id="ship_cost" name="ship_cost"
                                                                    class="total" disabled value="0.00">
                                                            </div>
                                                            <div class="inner-inner-inner">
                                                                <h5>GRADN TOTAL</h5>
                                                                <input type="number" id="grand_total" name="grand_total"
                                                                    class="total" disabled value="0.00">
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="inner-section py-3">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <div class="div-a">
                                                        <h2 class="a1" style="font-size:12px">Inventory Orders</h2>
                                                        <p class="a2" style="font-size:10px">View & edit inventory
                                                            orders</p>
                                                    </div>
                                                </div>
                                                <div class="col-sm-9 float-1">
                                                    <button class="purchase-btn"><i class="fa-solid fa-file"></i> Purchase
                                                        Orders</button>
                                                    <button class="purchase-btn"><i class="fa-solid fa-plus"></i>
                                                        Inventory Order</button>
                                                    <button class="purchase-btn"><i class="fa-solid fa-file"></i> Stock
                                                        Levels</button>
                                                    <button class="purchase-btn"><i class="fa-solid fa-file"></i>
                                                        Reallocate Inventory</button>
                                                    <button class="purchase-btn"><i class="fa-solid fa-file"></i> Product
                                                        Catalog</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="inner-section-2">
                                        <div class="container">
                                            <div class="form-div">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="inner-header bg-light pt-2 pb-2">
                                                            <h3 class="primary"><i
                                                                    class="fa-solid fa-calendar-days"></i>Order
                                                                History</h3>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <table class="table table-bordered table-striped table-inv">
                                                        <thead>
                                                            <tr>
                                                                <th>Sent Date</th>
                                                                <th>Supplier</th>
                                                                <th>Ref #/Memo</th>
                                                                <th>Payment Term</th>
                                                                <th>Total</th>
                                                                <th>Item Name</th>
                                                                <th>Actions</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="myTable">
                                                            @foreach ($purchase as $purchases )

                                                            <tr>
                                                                <td>{{ $purchases->sent_date }}</td>
                                                                <td>{{ $purchases->supplier }}</td>
                                                                <td>{{ $purchases->memo_id }}</td>
                                                                <td>{{ $purchases->payment_term }}</td>
                                                                <td>{{ $purchases->total }}</td>
                                                                <td>{{ $purchases->item_name }}</td>
                                                                <td>
                                                                    <a href="{{ route('purchase-orders.show', $purchases->id) }}" class="btn btn-info">Show</a>
                                                                   
                                                                </td>
                                                            </tr>
                                                            @endforeach

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="inner-section py-3">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="div-a">
                                                        <h2 class="a1" style="font-size: 15px;">Inventory Management
                                                        </h2>
                                                        <p class="a2" style="font-size: 13px;">View and manage
                                                            inventory</p>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 float-1">
                                                    <button class="purchase-btn"> Manage Warehouses</button>
                                                    <button class="purchase-btn">Inventory Orders</button>
                                                    <button class="purchase-btn">Purchase Orders</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="inner-section-2">
                                        <div class="container">
                                            <div class="form-div">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="inner-header bg-light pt-2 pb-2">
                                                            <h3 class="primary"> PRODUCT VIEW</h3>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="btn-div">
                                                            <button class="product-view-btn active"><img
                                                                    src="{{ asset('assets/images/2.png') }}"> ALL
                                                                PRODUCTS <span class="number-1">507</span> </button>
                                                            <button class="product-view-btn"><img
                                                                    src="{{ asset('assets/images/3.png') }}"> OPEN pos
                                                                <span class="number-1">5</span></button>
                                                            <button class="product-view-btn"><img
                                                                    src="{{ asset('assets/images/4.png') }}"> LOW
                                                                STOCK <span class="number-1">13</span></button>
                                                            <button class="product-view-btn"><img
                                                                    src="{{ asset('assets/images/1.png') }}"> SUBLOCATION
                                                                ASSIGNMENT <span class="number-1">70</span></button>
                                                        </div>
                                                        <div class="btn-div-content">
                                                            <div class="inner-header bg-light pt-2 pb-2">
                                                                <h3 class="primary-all"> Inventory: All Products </h3>
                                                                <button class="purchase-btn"><i
                                                                        class="fa-solid fa-print"></i> Print</button>
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
        </section>

    </div>
@endsection
