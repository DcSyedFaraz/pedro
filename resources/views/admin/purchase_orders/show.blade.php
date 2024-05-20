@extends(Auth::user()->hasRole('Admin')? 'admin.layouts.app' :  'manager.layouts.app' )

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container mt-4">
            <h1 class="display-4">{{ __('admin/purchase_order/show.purchase_order_details') }}</h1>
            <table class="table table-bordered table-striped">
                <tbody>
                    @foreach($purchaseOrder->getAttributes() as $key => $value)
                        <tr>
                            <th>{{ __('admin/purchase_order/show.'.$key) }}</th>
                            <td>{{ $value }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="text-center">
                <a href="{{ route('purchase-orders.index') }}" class="btn btn-primary btn-lg">{{ __('admin/purchase_order/show.back_to_list') }}</a>
            </div>
        </div>
    </section>
</div>
@endsection
