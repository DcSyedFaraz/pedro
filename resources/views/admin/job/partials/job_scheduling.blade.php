<div class="row">
        <div class="col-md-4">
            <strong>Current Status</strong>
        </div>
        <div class="col-md-8">
            <div class="form-group">
                <select id="fruits" name="current_status" class="form-control" >
                    <option value="" selected hidden disabled>Select status</option>
                    <option {{ old('current_status', isset($job) ? $job->current_status : '') == '1' ? 'selected' : '' }} value="1">Unscheduled</option>
                    <option {{ old('current_status', isset($job) ? $job->current_status : '') == '2' ? 'selected' : '' }} value="2">Scheduled</option>
                    <option {{ old('current_status', isset($job) ? $job->current_status : '') == '3' ? 'selected' : '' }} value="3">Dispatch</option>
                    <option {{ old('current_status', isset($job) ? $job->current_status : '') == '4' ? 'selected' : '' }} value="4">Canceled</option>
                    <option {{ old('current_status', isset($job) ? $job->current_status : '') == '5' ? 'selected' : '' }} value="5">Rescheduled</option>
                    <option {{ old('current_status', isset($job) ? $job->current_status : '') == '6' ? 'selected' : '' }} value="6">On Site</option>
                    <option {{ old('current_status', isset($job) ? $job->current_status : '') == '7' ? 'selected' : '' }} value="7">In Process</option>
                    <option {{ old('current_status', isset($job) ? $job->current_status : '') == '8' ? 'selected' : '' }} value="8">Partially</option>
                    <option {{ old('current_status', isset($job) ? $job->current_status : '') == '9' ? 'selected' : '' }} value="9">Completed</option>
                </select>
                <p class="current-status-error error-message error-messages" style="display: none;">Please select a current status</p>
            </div>
        </div>
        <div class="col-md-2">
        </div>
</div>
<hr/>
<div class="row">
            <div class="col-md-4">
                <strong>Start & End Dates</strong>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <input value="{{ isset($job->start_date) ? old('start_date', $job->start_date) : '' }}" type="date" class="form-control" name="start_date" placeholder="Start Date">
                    <p class="start-date-error error-message error-messages" style="display: none;">Enter a valid start date</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <input value="{{ isset($job->end_date) ? old('end_date', $job->end_date) : '' }}" type="date" class="form-control" name="end_date" placeholder="End Date">
                    <p class="end-date-error error-message error-messages" style="display: none;">Enter a valid start date</p>
                </div>
            </div>
</div>
<hr/>
<div class="row">
            <div class="col-md-4">
            <strong>Arrival Time Window</strong>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <input value="{{ isset($job->start_time) ? old('start_time', $job->start_time) : '' }}" type="time" class="form-control" name="start_time" placeholder="Start Time" >
                    <p class="start-time-error error-message error-messages" style="display: none;">Enter a valid start time</p>
                </div>
            </div>
            <div class="col-md-4">
            <input value="{{ isset($job->end_time) ? old('end_time', $job->end_time) : '' }}" type="time" class="form-control" name="end_time" placeholder="End Time" >
            <p class="end-time-error error-message error-messages" style="display: none;">Enter a valid start time</p>
        </div>
</div>

<div class="row">
            <div class="col-md-4">
            <strong>Estimated Duration</strong>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <input value="{{ isset($job->start_duration) ? old('start_duration', $job->start_duration) : '' }}" type="number" class="form-control" name="start_duration" placeholder="1" >
                    <p class="start-duration-error error-message error-messages" style="display: none;">Enter a valid start duration</p>
                </div>
            </div>
            <div class="col-md-4">
            <input value="{{ isset($job->end_duration) ? old('end_duration', $job->end_duration) : '' }}" type="number" class="form-control" name="end_duration" placeholder="0" >
            <p class="start-duration-error error-message error-messages" style="display: none;">Enter a valid end duration</p>

        </div>
</div>
<hr/>
<div class="row">
            <div class="col-md-4">
                <strong>Job Prority</strong>
            </div>
            <div class="col-md-8">
                <div class="form-group">
                <select id="job_pro" name="job_priority" class="form-control" >
                    <option value="">Select Job Prority</option>
                    @foreach($job_prioirty as $job_por)
                    <option {{ isset($job->job_priority) ? (old('job_priority', $job->job_priority) ? 'selected' : '') : '' }}
                     value="{{$job_por->id}}">{{$job_por->name}}</option>
                    @endforeach
                </select>
                <p class="job-priority-error error-message error-messages" style="display: none;">Select a job priority</p>
                </div>
            </div>
</div>
<hr/>
<div class="row">
            <div class="col-md-4">
                <strong>Assign Techs</strong>
            </div>
            <div class="col-md-8">
                <div class="form-group">
                <input value="{{ isset($job->assigned_tech) ? old('assigned_tech', $job->assigned_tech) : '' }}" type="text" class="form-control" name="assigned_tech" placeholder="techs" >
                <p class="assigned-tech-error error-message error-messages" style="display: none;">Please enter the assigned tech(s)</p>
                </div>
            </div>
</div>
<div class="row">
            <div class="col-md-4">
            </div>
            <div class="col-md-6">
                <div class="form-group">
                <input {{ isset($job->notify_tech_assign) && $job->notify_tech_assign ? 'checked' : '' }} type="checkbox"  name="notify_tech_assign" placeholder="Location Name(e.g Home or Office)" > Notifiy all tech(s)assigned
                </div>
            </div>
</div>
<hr/>
<div class="row">
            <div class="col-md-4">
                <strong>Notes For Techs</strong>
            </div>
            <div class="col-md-8">
                <div class="form-group">
                <textarea class="form-control" name="notes_for_tech" placeholder="Notes For Techs.">{{ isset($job->notes_for_tech) ? old('notes_for_tech', $job->notes_for_tech) : '' }}</textarea>
                <p class="notes-for-tech-error error-message error-messages" style="display: none;"></p>
            </div>
            </div>
</div>
<hr/>
<div class="row">
            <div class="col-md-4">
                <strong>Completion Notes</strong>
            </div>
            <div class="col-md-8">
                <div class="form-group">
                <textarea  class="form-control" name="completion_notes" placeholder="Completion Notes.">{{ isset($job->completion_notes) ? old('completion_notes', $job->completion_notes) : '' }}</textarea>
                <p class="completion-notes-error error-message error-messages" style="display: none;">Please enter completion notes</p>

            </div>
            </div>
</div>
