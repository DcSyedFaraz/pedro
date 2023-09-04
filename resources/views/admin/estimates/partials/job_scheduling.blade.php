<style>
        .rating {
            display: inline-block;
        }
        
        .rating input {
            display: none;
        }
        
        .rating label {
            font-size: 30px;
            color: #ccc;
            cursor: pointer;
        }
        
        .rating label:hover,
        .rating label:hover ~ label {
            color: #d37312;
        }
        
        .rating input:checked ~ label {
            color: #d37312;
        }
    </style>
<div class="row">
    <div class="col-md-4">
        <strong>Requested On</strong>
    </div>
    <div class="col-md-8">
        <div class="form-group">
            <input type="date" class="form-control" name="requested_on" placeholder="Start Date">
            <p class="start-date-error error-message error-messages" style="display: none;">Enter a valid start date</p>
        </div>
    </div>
</div>
            
<hr/>           
<div class="row">
        <div class="col-md-4">
            <strong>Current Status</strong>
        </div>
        <div class="col-md-8">
            <div class="form-group">
                <select id="fruits" name="current_status" class="form-control" >
                    <option value="">Estimates Request</option>
                    <option value="1">Unscheduled</option>
                    <option value="2">Scheduled</option>
                    <option value="3">Dispatch</option>
                    <option value="4">Canceled</option>
                    <option value="5">Rescheduled</option>
                    <option value="6">On Site</option>
                    <option value="7">In Process</option>
                    <option value="8">Partially</option>
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
            <strong>Referral Source</strong>
        </div>
        <div class="col-md-8">
            <div class="form-group">
                <select id="fruits" name="referral_source" class="form-control" >
                    <option value="">No Source</option>
                    <option value="1">Presonal</option>
                    <option value="2">Contacts</option>
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
            <strong>Opportunity Rating</strong>
        </div>
        <div class="col-md-8">
            <div class="form-group">
                <div class="rating">
                    <input type="radio" id="star5" name="opportunity_rating" value="5" />
                    <label for="star5">&#9733;</label>
                    <input type="radio" id="star4" name="opportunity_rating" value="4" />
                    <label for="star4">&#9733;</label>
                    <input type="radio" id="star3" name="opportunity_rating" value="3" />
                    <label for="star3">&#9733;</label>
                    <input type="radio" id="star2" name="opportunity_rating" value="2" />
                    <label for="star2">&#9733;</label>
                    <input type="radio" id="star1" name="opportunity_rating" value="1" checked />
                    <label for="star1">&#9733;</label>
                </div>   
            </div>
        </div>
        <div class="col-md-2">
        </div>
</div>
<hr/>
<div class="row">
        <div class="col-md-4">
            <strong>Tags</strong>
        </div>
        <div class="col-md-8">
            <div class="form-group">
                <input type="text" class="form-control" name="tags" placeholder="Type to add a Tags">
                <p class="tags-error error-message error-messages" style="display: none;">Please select a current status</p>
            </div>
        </div>
        <div class="col-md-2">
        </div>
</div>
<hr/>

<div class="row">
        <div class="col-md-4">
            <strong>Opportunity Owner</strong>
        </div>
        <div class="col-md-8">
            <div class="form-group">
            <input type="text" class="form-control" name="opportunity_owner" placeholder="Opportunity Owner">
                <p class="opportunity-owner-error error-message error-messages" style="display: none;">Please select a current status</p>
            </div>
        </div>
        <div class="col-md-2">
        </div>
</div>
<hr/>

<div class="row">    
            <div class="col-md-4">
                <strong>On-Site Visit</strong>
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
  
            <div class="col-md-4">
            <strong></strong>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <input type="text" class="form-control" name="arrival_start" placeholder="Arrival Start" >
                    <p class="start-time-error error-message error-messages" style="display: none;">Enter a valid Arrival Start</p>
                </div>
            </div>
            <div class="col-md-4">
            <input type="text" class="form-control" name="arrival_end" placeholder="Arrival End" >
            <p class="end-time-error error-message error-messages" style="display: none;">Enter a valid Arrival End</p>
        </div>
</div>

<div class="row">    
            <div class="col-md-4">
            <strong></strong>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <input type="number" class="form-control" name="start_duration" placeholder="1">
                    <p class="start-duration-error error-message error-messages" style="display: none;">Enter a valid start duration</p>
                </div>
                
            </div>
            <span style="margin: 5px;color: #7b7878;">h</span>
            <div class="col-md-2">
                <input type="number" class="form-control" name="end_duration" placeholder="1">
                <p class="start-duration-error error-message error-messages" style="display: none;">Enter a valid end duration</p>
            </div>
            <span style="margin: 5px;color: #7b7878;">m</span>
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