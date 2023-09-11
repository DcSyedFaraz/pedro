        <!-- <label for="task">Task:</label>
        <input type="text" name="task" id="task" required> -->

        <label for="drive_time">Drive Time:</label>
        <input value="{{ isset($invoice->drive_time) ? old('drive_time', $invoice->drive_time) : '' }}" type="number" step="0.01" name="drive_time" class="form-control job_drive_time" id="job_drive_time" required>

        <label for="labor_time">Labor Time:</label>
        <input value="{{ isset($invoice->labor_time) ? old('labor_time', $invoice->labor_time) : '' }}" type="number" step="0.01" name="labor_time" class="form-control job_labor_time" id="job_labor_time" required>

        <label for="labor_time">Payment And Deposit</label>
        <input value="{{ isset($invoice->payments_and_deposits_input) ? old('payments_and_deposits_input', $invoice->payments_and_deposits_input) : '' }}" type="number" step="0.01" name="payments_and_deposits_input" class="form-control job_payments_and_deposits_input" id="job_payments_and_deposits_input" required>
