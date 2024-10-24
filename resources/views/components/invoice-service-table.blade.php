<div class="row">
    <div class="col">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th class="table-header-flex position-relative">
                        <i class="fas fa-exclamation-circle position-absolute top-0 start-0 p-1 text-warning"
                            title="Group Information"></i>
                        <button class="btn btn-md btn-primary group-button">Group</button>
                    </th>
                    <th class="table-header-flex position-relative">
                        <span>Description</span>
                        <i class="fas fa-info-circle position-absolute top-0 start-100 translate-middle p-1 text-info"
                            title="Provide a detailed description"></i>
                    </th>
                    {{-- <th>Warehouse</th> --}}
                    <th>Qty/Hrs</th>
                    <th>Rate</th>
                    <th>Total</th>
                    <th>Cost</th>
                    <th>Margin Tax</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="job-invoice-rows">
                @if (isset($invoice->service) && $invoice->service->isNotEmpty())
                    @foreach ($invoice->service as $y => $service)
                        <tr>
                            <td colspan="2">
                                <input value="{{ $service->description ?? '' }}" type="text"
                                    class="form-control inv_desc" name="description[]" placeholder="Description">
                            </td>
                            {{-- <td>
                                <input value="{{ $service->warehouse ?? '' }}" type="text"
                                    class="form-control job_inv_whr" name="warehouse[]" placeholder="Warehouse">
                            </td> --}}
                            <td>
                                <input value="{{ $service->qty_hrs ?? '' }}" type="number"
                                    class="form-control job_inv_qty" name="qty_hrs[]" placeholder="Qty">
                            </td>
                            <td>
                                <input value="{{ $service->rate ?? '' }}" type="number"
                                    class="form-control job_inv_rate" name="rate[]" placeholder="Rate">
                            </td>
                            <td>
                                <input value="{{ $service->total ?? '' }}" type="number"
                                    class="form-control job_inv_total" name="total[]" placeholder="Total" readonly>
                            </td>
                            <td>
                                <input value="{{ $service->cost ?? '' }}" type="number"
                                    class="form-control job_inv_cost" name="cost[]" placeholder="Cost">
                            </td>
                            <td>
                                <input value="{{ $service->margin_tax ?? '' }}" type="number"
                                    class="form-control job_inv_tax" name="margin_tax[]" placeholder="Tax">
                            </td>
                            <td class="d-flex justify-content-center align-items-center">
                                @if (!$loop->first)
                                    <a href="{{ route($deleteRoute, $service->id) }}"
                                        class="btn btn-sm btn-danger calculate-button" data-row="{{ $y }}"
                                        onclick="event.preventDefault(); document.getElementById('delete-form-{{ $service->id }}').submit();"
                                        title="Delete Service">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    <form id="delete-form-{{ $service->id }}"
                                        action="{{ route($deleteRoute, $service->id) }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                @endif
                                @if ($loop->last)
                                    @if ($addRoute)
                                        <a href="{{ route($addRoute) }}"
                                            class="btn btn-sm btn-success calculate-button" id="job-multiple-primary"
                                            data-row="{{ $y }}" title="Add Service">
                                            <i class="fas fa-plus"></i>
                                        </a>
                                    @else
                                        <button type="button" class="btn btn-sm btn-success calculate-button"
                                            id="job-multiple-primary" data-row="{{ $y }}"
                                            title="Add Service">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="2">
                            <input type="text" class="form-control inv_desc" name="description[]"
                                placeholder="Description">
                        </td>
                        {{-- <td>
                            <input type="text" class="form-control job_inv_whr" name="warehouse[]"
                                placeholder="Warehouse">
                        </td> --}}
                        <td>
                            <input type="number" class="form-control job_inv_qty" name="qty_hrs[]" placeholder="Qty">
                        </td>
                        <td>
                            <input type="number" class="form-control job_inv_rate" name="rate[]" placeholder="Rate">
                        </td>
                        <td>
                            <input type="number" class="form-control job_inv_total" name="total[]" placeholder="Total"
                                readonly>
                        </td>
                        <td>
                            <input type="number" class="form-control job_inv_cost" name="cost[]" placeholder="Cost">
                        </td>
                        <td>
                            <input type="number" class="form-control job_inv_tax" name="margin_tax[]"
                                placeholder="Tax">
                        </td>
                        <td>
                            @if ($addRoute)
                                <a href="{{ route($addRoute) }}" class="btn btn-sm btn-success calculate-button"
                                    id="job-multiple-primary" data-row="1" title="Add Service">
                                    <i class="fas fa-plus"></i>
                                </a>
                            @else
                                <button type="button" class="btn btn-sm btn-success calculate-button"
                                    id="job-multiple-primary" data-row="1" title="Add Service">
                                    <i class="fas fa-plus"></i>
                                </button>
                            @endif
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Delegate the event to handle dynamic rows
        document.body.addEventListener('click', function(e) {
            if (e.target.closest('.btn-success')) {
                // Handle adding a new row
                let tableBody = document.getElementById('job-invoice-rows');
                let lastRow = tableBody.lastElementChild;
                let newRow = lastRow.cloneNode(true);

                // Clear input values
                newRow.querySelectorAll('input').forEach(function(input) {
                    input.value = '';
                    if (input.hasAttribute('readonly')) {
                        input.value = '';
                    }
                });

                // Remove delete button if it's the first row
                if (tableBody.children.length === 1) {
                    newRow.querySelector('.btn-danger')?.remove();
                }

                // Update the row number or data attributes if necessary
                tableBody.appendChild(newRow);
            }
        });
    });
</script>
