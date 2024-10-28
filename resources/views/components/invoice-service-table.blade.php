<div class="row">
    <div class="col">
        {{-- <form action="{{ $route }}" method="POST" id="estimate-form">
            @csrf --}}
        <table class="table">
            <thead>
                <tr>
                    <th class="table-header-flex">
                        <i class="fa fa-exclamation-circle"
                            style="position: absolute; top: 0; left: 0; padding: 3px;"></i>
                        <button type="button" class="btn btn-md group-button">Group</button>
                    </th>
                    <th class="table-header-flex">
                        <span>{{ __('admin/estimates/edit.description') }}</span>
                    </th>
                    <th>{{ __('admin/estimates/edit.qty_hours') }}</th>
                    <th>{{ __('admin/estimates/edit.rate') }}</th>
                    <th>{{ __('admin/estimates/edit.margin_tax') }}</th>
                    <th>{{ __('admin/estimates/edit.total') }}</th>
                    <th>{{ __('admin/estimates/edit.cost') }}</th>
                    <th>{{ __('admin/estimates/edit.action') }}</th>
                </tr>
            </thead>
            <tbody id="est-invoice-rows">
                @foreach ($rows as $index => $row)
                    <tr>
                        <td colspan="2">
                            <input type="text" class="form-control est_inv_desc" name="description[]"
                                placeholder="{{ __('admin/estimates/edit.description') }}"
                                value="{{ old('description.' . $index, $row['description']) }}">
                        </td>
                        <td>
                            <input type="number" class="form-control est_inv_qty" name="qty_hrs[]"
                                placeholder="{{ __('admin/estimates/edit.qty_hours') }}"
                                value="{{ old('qty_hrs.' . $index, $row['qty_hrs']) }}">
                        </td>
                        <td>
                            <input type="number" class="form-control est_inv_rate" name="rate[]"
                                placeholder="{{ __('admin/estimates/edit.rate') }}"
                                value="{{ old('rate.' . $index, $row['rate']) }}">
                        </td>
                        <td>
                            <span class="est_inv_tax">
                                0.00%
                            </span>
                            {{-- <input type="text" disabled class="form-control est_inv_tax" name="margin_tax[]"
                                    placeholder="{{ __('admin/estimates/edit.margin_tax') }}"
                                    value="{{ old('margin_tax.' . $index, $row['margin_tax']) }}"> --}}
                        </td>
                        <td>
                            <input type="number" class="form-control est_inv_total" name="total[]"
                                placeholder="{{ __('admin/estimates/edit.total') }}"
                                value="{{ old('total.' . $index, $row['total']) }}" readonly>
                        </td>
                        <td>
                            <input type="number" class="form-control est_inv_cost" name="cost[]"
                                placeholder="{{ __('admin/estimates/edit.cost') }}"
                                value="{{ old('cost.' . $index, $row['cost']) }}">
                        </td>
                        <td>
                            @if ($index === 0)
                                <button type="button" class="btn calculate-button" id="est_multiples_primary"
                                    data-route="{{ $route }}">
                                    <i class="fas fa-plus text-primary"></i>
                                </button>
                            @else
                                <button type="button" class="btn remove-button">
                                    <i class="fas fa-minus text-danger"></i>
                                </button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <!-- Optionally, add a submit button -->
        {{-- <button type="submit" class="btn btn-success">Save Estimate</button> --}}
        {{-- </form> --}}
    </div>
</div>

