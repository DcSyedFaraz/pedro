<div class="row">
    <div class="col">
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
                @forelse ($job->invoice as $index => $row)
                    <tr>
                        <td colspan="2">
                            <input type="text" class="form-control est_inv_desc" name="description[]"
                                placeholder="{{ __('admin/estimates/edit.description') }}"
                                value="{{ old('description.' . $index, $row['description'] ?? '') }}">
                        </td>
                        <td>
                            <input type="number" class="form-control est_inv_qty" name="qty_hrs[]"
                                placeholder="{{ __('admin/estimates/edit.qty_hours') }}"
                                value="{{ old('qty_hrs.' . $index, $row['qty_hrs'] ?? '') }}">
                        </td>
                        <td>
                            <input type="number" class="form-control est_inv_rate" name="rate[]"
                                placeholder="{{ __('admin/estimates/edit.rate') }}"
                                value="{{ old('rate.' . $index, $row['rate'] ?? '') }}">
                        </td>
                        <td>
                            <span class="est_inv_tax">0.00%</span>
                        </td>
                        <td>
                            <input type="number" class="form-control est_inv_total" name="total[]"
                                placeholder="{{ __('admin/estimates/edit.total') }}" readonly
                                value="{{ old('total.' . $index, $row['total'] ?? '') }}">
                        </td>
                        <td>
                            <input type="number" class="form-control est_inv_cost" name="cost[]"
                                placeholder="{{ __('admin/estimates/edit.cost') }}"
                                value="{{ old('cost.' . $index, $row['cost'] ?? '') }}">
                        </td>
                        <td>
                            @if ($loop->first)
                                <button type="button" class="btn calculate-button" id="est_multiples_primary">
                                    <i class="fas fa-plus text-primary"></i>
                                </button>
                            @else
                                <button type="button" class="btn remove-button">
                                    <i class="fas fa-minus text-danger"></i>
                                </button>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2">
                            <input type="text" class="form-control est_inv_desc" name="description[]"
                                placeholder="Description"
                                value="{{ old('description.0', $row['description'] ?? '') }}">
                        </td>
                        <td>
                            <input type="number" class="form-control est_inv_qty" name="qty_hrs[]" placeholder="Qty"
                                value="{{ old('qty_hrs.0', $row['qty_hrs'] ?? '') }}">
                        </td>
                        <td>
                            <input type="number" class="form-control est_inv_rate" name="rate[]" placeholder="Rate"
                                value="{{ old('rate.0', $row['rate'] ?? '') }}">
                        </td>
                        <td>
                            <span class="est_inv_tax">0.00%</span>
                        </td>
                        <td>
                            <input type="number" class="form-control est_inv_total" name="total[]" placeholder="Total"
                                readonly value="{{ old('total.0', $row['total'] ?? '') }}">
                        </td>
                        <td>
                            <input type="number" class="form-control est_inv_cost" name="cost[]" placeholder="Cost"
                                value="{{ old('cost.0', $row['cost'] ?? '') }}">
                        </td>
                        <td>
                            <button type="button" class="btn calculate-button" id="est_multiples_primary"
                                data-row="1">
                                <i class="fas fa-plus text-primary"></i>
                            </button>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
