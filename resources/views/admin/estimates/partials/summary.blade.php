            <div class="row">
                <div class="col-md-4">
                    <strong>Customer</strong>
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                    
                        <select name="customer_id" id="customer_id" class="form-control" >
                            <option value="">select Customer</option>
                            @foreach($customer as $cust)
                            <option value="{{$cust->id}}">{{$cust->name}}</option>
                            @endforeach
                        </select>
                        <span class="error-message error-messages" id="customer_id_error"></span><br>
                    </div>
                </div>
            </div>
            <hr/>
            <div class="row">    
                <div class="col-md-4">
                    <strong>Primary Contact</strong>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <input class="form-control" name="first_name" id="first_name" placeholder="First Name">
                        <span class="error-message error-messages" id="first_name_error"></span><br>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                    <input class="form-control" name="last_name" id="last_name" placeholder="Last Name">
                    <span class="error-message error-messages" id="last_name_error"></span><br>
                    </div>
                </div>
            </div>
            <div class="primary_append">
                <div class="row">    
                <div class="col-md-4">
                    &nbsp;   
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <input type="tel" class="form-control" name="phone[]" id="" placeholder="Phone number" >
                        <p class="error-message phone-error error-messages" style="display: none;"> Add at least phone </p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                    <input type="tel" class="form-control" name="ext[]" placeholder="Ext">
                    <p class="ext-error error-messages" style="display: none;">Add at least ext</p>
                    </div>
                
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn" id="add-primary"><i class="fas fa-plus text-primary"></i></button>
                </div>
                </div>
            </div>      
            <div class="email_append">   
                <div class="row" >    
                <div class="col-md-4">&nbsp;</div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="tel" class="form-control" name="email[]" placeholder="Email" >
                        <p class="email-error error-messages" style="display: none">Add at least email.</p>
                    </div>
                </div>
                <!-- Add a Remove button -->
                <div class="col-md-2">
                    <button type="button" class="btn" id="add-email"><i class="fas fa-plus text-primary"></i></button>
                </div>
                </div>
            </div>
            <hr/>
            <div class="row">    
                <div class="col-md-4">
                    <strong>Service Location</strong>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <input type="text" class="form-control" name="location_name" placeholder="Location Name(e.g Home or Office)" >
                    </div>
                </div>
                <div class="col-md-4">
                        <input type="checkbox"  name="location_gated_property" placeholder="Location Name(e.g Home or Office)" > Gated Property
                </div>
            </div>
            <div class="row">    
                        <div class="col-md-4">
                            &nbsp;
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <input type="tel" class="form-control" name="location_address" placeholder="Street Address or Latitude Logitude" >
                            </div>
                        </div>
                        <div class="col-md-3">
                        <input type="tel" class="form-control" name="location_unit" placeholder="Site/Unit/Apt" >
                        </div>
            </div>
            <div class="row">    
                        <div class="col-md-4">
                        
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="text" class="form-control" name="location_city" placeholder="City" >
                            </div>
                        </div>
                        <div class="col-md-3">
                                <input type="text" class="form-control" name="location_state" placeholder="State/Province" >
                        </div>
                        <div class="col-md-2">
                                <input type="text"  class="form-control" name="location_zipcode" placeholder="Zip/Postal Code" > 
                        </div>
            </div>
            <hr/>
            <div class="row">    
                <div class="col-md-4">
                    <strong>Job Category</strong>
                </div>
            
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="jobCategory">Job Category</label>
                        <select id="job-cat-id" name="job_cat_id" class="form-control">
                            <option value="">Select a Job Category</option>
                            @foreach($jobCategories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <span class="error-message error-messages" id="job-cat-id_error"></span><br>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="jobSubcategory">Job Sub Category</label>
                        <select id="jobSubcategory" name="job_sub_cat_id" class="form-control">
                            <option value="">Select a job subcategory</option>
                        </select>
                        <span class="error-message error-messages" id="jobSubcategory_error"></span><br>
                    </div>
                </div>
                        
            </div>

<div class="row">
    <div class="col-md-4">
        <strong>&nbsp;</strong>
    </div>
    <div class="col-md-8">
        <div class="form-group">
            <label for="jobSubDescription">Job Sub Description</label>
            <textarea id="jobSubDescription" name="job_sub_description" class="form-control" placeholder="Job Sub Category Description"></textarea>
        </div>
    </div>
</div>
<hr/>
<div class="row">    
            <div class="col-md-4">
                <strong>Job Description</strong>
            </div>
            <div class="col-md-8">
                <div class="form-group">
                <textarea  class="form-control" name="job_description" placeholder="Job Desciption"></textarea> 
                </div>
            </div>
</div>
<hr/>
<div class="row">    
            <div class="col-md-4">
                <strong>PO #</strong>
            </div>
            <div class="col-md-8">
                <div class="form-group">
                <input type="tel" class="form-control" name="po_no" placeholder="PO Number" >
                </div>
            </div>
</div>
<hr/>
<div class="row">    
            <div class="col-md-4">
                <strong>Job Source</strong>
            </div>
            <div class="col-md-8">
                <div class="form-group">
                <select id="job_sour" name="job_source" class="form-control" >
                    <option value="">Select Job Source</option>
                    @foreach($job_source as $job_sour)
                    <option value="{{$job_sour->id}}">{{$job_sour->name}}</option>
                    @endforeach
                </select>
                <span class="error-message error-messages" id="job_sour_error"></span><br>
                </div>
            </div>
</div>
<hr/>
<div class="row">    
            <div class="col-md-4">
                <strong>Agent/Rep</strong>
            </div>
            <div class="col-md-8">
                <div class="form-group">
                <input type="tel" class="form-control" name="agent" placeholder="Select Agents"> 
                </div>
            </div>
</div>