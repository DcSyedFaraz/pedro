@extends(Auth::user()->hasRole('Admin') ? 'admin.layouts.app' :  'manager.layouts.app' )
 {{-- You can customize the layout as needed --}}

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
<section class="content-header">
<div class="container mt-4">
    <h1 class="display-4">Purchase Order Details</h1>
    <table class="table table-bordered table-striped">
        <tbody>
            <tr>
                <th class="w-25">Supplier</th>
                <td>{{ $purchaseOrder->supplier }}</td>
            </tr>
            <tr>
                <th>Order Reference</th>
                <td>{{ $purchaseOrder->order_ref }}</td>
            </tr>
            <tr>
                <th>Order Progress</th>
                <td>{{ $purchaseOrder->order_progress }}</td>
            </tr>
            <tr>
                <th>Payment Term</th>
                <td>{{ $purchaseOrder->payment_term }}</td>
            </tr>
            <tr>
                <th>Order Date</th>
                <td>{{ $purchaseOrder->order_date }}</td>
            </tr>
            <tr>
                <th>Sender</th>
                <td>{{ $purchaseOrder->sender }}</td>
            </tr>
            <tr>
                <th>Memo ID</th>
                <td>{{ $purchaseOrder->memo_id }}</td>
            </tr>
            <tr>
                <th>Ship Option</th>
                <td>{{ $purchaseOrder->ship_option }}</td>
            </tr>
            <tr>
                <th>Sent Date</th>
                <td>{{ $purchaseOrder->sent_date }}</td>
            </tr>
            <tr>
                <th>Receipt Status</th>
                <td>{{ $purchaseOrder->receipt_status }}</td>
            </tr>
            <tr>
                <th>Direct Shipping</th>
                <td>{{ $purchaseOrder->direct_shipping }}</td>
            </tr>
            <tr>
                <th>Location</th>
                <td>{{ $purchaseOrder->location }}</td>
            </tr>
            <tr>
                <th>Street</th>
                <td>{{ $purchaseOrder->street }}</td>
            </tr>
            <tr>
                <th>Apt</th>
                <td>{{ $purchaseOrder->apt }}</td>
            </tr>
            <tr>
                <th>Tampa</th>
                <td>{{ $purchaseOrder->tampa }}</td>
            </tr>
            <tr>
                <th>FL</th>
                <td>{{ $purchaseOrder->fl }}</td>
            </tr>
            <tr>
                <th>Num</th>
                <td>{{ $purchaseOrder->num }}</td>
            </tr>
            <tr>
                <th>Item Name</th>
                <td>{{ $purchaseOrder->item_name }}</td>
            </tr>
            <tr>
                <th>Quantity</th>
                <td>{{ $purchaseOrder->qty }}</td>
            </tr>
            <tr>
                <th>Unit Price</th>
                <td>{{ $purchaseOrder->unit_price }}</td>
            </tr>
            <tr>
                <th>Total</th>
                <td>{{ $purchaseOrder->total }}</td>
            </tr>
            <tr>
                <th>Job Assign</th>
                <td>{{ $purchaseOrder->job_assign }}</td>
            </tr>
            <tr>
                <th>Receipt</th>
                <td>{{ $purchaseOrder->receipt }}</td>
            </tr>
            <tr>
                <th>Description</th>
                <td>{{ $purchaseOrder->description }}</td>
            </tr>
            <tr>
                <th>Subtotal</th>
                <td>{{ $purchaseOrder->subtotal }}</td>
            </tr>
            <tr>
                <th>Discount</th>
                <td>{{ $purchaseOrder->discount }}</td>
            </tr>
            <tr>
                <th>Tax Paid</th>
                <td>{{ $purchaseOrder->tax_paid }}</td>
            </tr>
            <tr>
                <th>Shipping Cost</th>
                <td>{{ $purchaseOrder->ship_cost }}</td>
            </tr>
            <tr>
                <th>Grand Total</th>
                <td>{{ $purchaseOrder->grand_total }}</td>
            </tr>
        </tbody>
    </table>
    <div class="text-center">
        <a href="{{ route('purchase-orders.index') }}" class="btn btn-primary btn-lg">Back to List</a>
    </div>
</div>
</section>
</div>
@endsection
