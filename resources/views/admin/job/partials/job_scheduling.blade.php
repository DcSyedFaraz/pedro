<div class="row">
        <div class="col-md-4">
            <strong>Current Status</strong>
        </div>
        <div class="col-md-8">
            <div class="form-group">
                <select id="fruits" name="current_status" class="form-control" >
                    <option value="">Select status</option>
                    <option value="1">Unscheduled</option>
                    <option value="2">Scheduled</option>
                    <option value="3">Dispatch</option>
                    <option value="4">Canceled</option>
                    <option value="5">Rescheduled</option>
                    <option value="6">On Site</option>
                    <option value="7">In Process</option>
                    <option value="8">Partially</option>
                    <option value="9">Completed</option>
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
                    <input type="date" class="form-control" name="start_date" placeholder="Start Date">
                    <p class="start-date-error error-message error-messages" style="display: none;">Enter a valid start date</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <input type="date" class="form-control" name="end_date" placeholder="End Date">
                    <p class="end-date-error error-message error-messages" style="display: none;">Enter a valid start date</p>
                </div>
            </div>
</div>
<!-- <div class="row">
    <div class="col-md-4">&nbsp;</div>
    <div class="col-md-8">
                <div class="form-group">
                <input type="checkbox"  name="email" placeholder="Location Name(e.g Home or Office)" > Multi-day job
                </div>
            </div>
</div> -->
<hr/>
<div class="row">    
            <div class="col-md-4">
            <strong>Arrival Time Window</strong>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <input type="time" class="form-control" name="start_time" placeholder="Start Time" >
                    <p class="start-time-error error-message error-messages" style="display: none;">Enter a valid start time</p>
                </div>
            </div>
            <div class="col-md-4">
            <input type="time" class="form-control" name="end_time" placeholder="End Time" >
            <p class="end-time-error error-message error-messages" style="display: none;">Enter a valid start time</p>
        </div>
</div>
<!-- <div class="row">    
            <div class="col-md-4">
            <strong></strong>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <input type="checkbox"  name="email" placeholder="Location Name(e.g Home or Office)" > Repeat This Job
                </div>
            </div>
</div> -->
<div class="row">    
            <div class="col-md-4">
            <strong>Estimated Duration</strong>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <input type="number" class="form-control" name="start_duration" placeholder="1" >
                    <p class="start-duration-error error-message error-messages" style="display: none;">Enter a valid start duration</p>
                </div>
            </div>
            <div class="col-md-4">
            <input type="number" class="form-control" name="end_duration" placeholder="0" >
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
                    <option value="{{$job_por->id}}">{{$job_por->name}}</option>
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
                <input type="text" class="form-control" name="assigned_tech" placeholder="techs" >
                <p class="assigned-tech-error error-message error-messages" style="display: none;">Please enter the assigned tech(s)</p>
                </div>
            </div>
</div>
<div class="row">    
            <div class="col-md-4">
            </div>
            <div class="col-md-6">
                <div class="form-group">
                <input type="checkbox"  name="notify_tech_assign" placeholder="Location Name(e.g Home or Office)" > Notifiy all tech(s)assigned
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
                <textarea class="form-control" name="notes_for_tech" placeholder="Notes For Techs."></textarea> 
                <p class="notes-for-tech-error error-message error-messages" style="display: none;">Please enter notes for techs</p> 
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
                <textarea  class="form-control" name="completion_notes" placeholder="Completion Notes."></textarea> 
                <p class="completion-notes-error error-message error-messages" style="display: none;">Please enter completion notes</p>
                
            </div>
            </div>
</div>