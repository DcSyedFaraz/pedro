                    <div class="row">
                        <div class="col">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="table-header-flex"><i class="fa fa-exclamation-circle" style="position: absolute;top: 0;left: 0;padding: 3px;"></i><button class="btn btn-md group-button">Group</button></th>
                                        <th class="table-header-flex"><span>Description</span> <i class="fa fa-exclamation-circle"style="position: absolute;top: 0;left: 0;padding: 30px 95px;"></i></th>
                                        <th>Qty/Hrs</th>
                                        <th>Rate</th>
                                        <th>Total</th>
                                        <th>Cost</th>
                                        <th>Margin Tax</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="est-invoice-rows">
                                <tr>
                                    <td colspan="2"><input type="text" class="form-control est_inv_desc" name="description" placeholder="Description"></td>
                                    <td><input type="number" class="form-control est_inv_qty" name="qty_hrs" placeholder="Qty"></td>
                                    <td><input type="number" class="form-control est_inv_rate" name="rate" placeholder="Rate"></td>
                                    <td><input type="number" class="form-control est_inv_total" name="total" placeholder="Total" readonly></td>
                                    <td><input type="number" class="form-control est_inv_cost" name="cost" placeholder="Cost"></td>
                                    <td><input type="number" class="form-control est_inv_tax" name="margin_tax" placeholder="Tax"></td>
                                    <td><button type="button" class="btn calculate-button" id="est_multiples_primary" data-row="1"><i class="fas fa-plus text-primary"></i></button></td>
                                </tbody>
                            </table>
                        </div>
                    </div>
