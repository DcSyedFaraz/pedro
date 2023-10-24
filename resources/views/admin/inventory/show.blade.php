@extends(Auth::user()->hasRole('Admin') ? 'admin.layouts.app' :  'manager.layouts.app' )


@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
<section class="content-header">
<div class="container mt-4">
    <h1 class="mb-4">Inventory Details</h1>

    <div class="card shadow p-3 mb-5 bg-white rounded">
        <div class="card-body">
            <table class="table table-bordered table-hover table-striped">
                <tbody>
                    <tr>
                        <th class="w-25">Vendor</th>
                        <td>{{ $inventory->vendor }}</td>
                    </tr>
                    <tr>
                        <th>Date</th>
                        <td>{{ $inventory->date }}</td>
                    </tr>
                    <tr>
                        <th>Paid For</th>
                        <td>{{ $inventory->paid_for }}</td>
                    </tr>
                    <tr>
                        <th>Paid</th>
                        <td>{{ $inventory->paid }}</td>
                    </tr>
                    <tr>
                        <th>Receive</th>
                        <td>{{ $inventory->receive }}</td>
                    </tr>
                    <tr>
                        <th>Product</th>
                        <td>{{ $inventory->product }}</td>
                    </tr>
                    <tr>
                        <th>Quantity</th>
                        <td>{{ $inventory->quantity }}</td>
                    </tr>
                    <tr>
                        <th>Unreceived</th>
                        <td>{{ $inventory->unreceived }}</td>
                    </tr>
                    <tr>
                        <th>Unit Cost</th>
                        <td>{{ $inventory->unit_cost }}</td>
                    </tr>
                    <tr>
                        <th>Total</th>
                        <td>{{ $inventory->total }}</td>
                    </tr>
                    <tr>
                        <th>Subtotal</th>
                        <td>{{ $inventory->subtotal }}</td>
                    </tr>
                    <tr>
                        <th>Discount</th>
                        <td>{{ $inventory->discount }}</td>
                    </tr>
                    <tr>
                        <th>Tax Paid</th>
                        <td>{{ $inventory->tax_paid }}</td>
                    </tr>
                    <tr>
                        <th>Ship Cost</th>
                        <td>{{ $inventory->ship_cost }}</td>
                    </tr>
                    <tr>
                        <th>Grand Total</th>
                        <td>{{ $inventory->grand_total }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
<div class="text-center">

    <a href="{{ route('inventory.index') }}" class="btn btn-primary mt-3">Back to Inventory List</a>
</div>
</div>
</section>
</div>
@endsection
