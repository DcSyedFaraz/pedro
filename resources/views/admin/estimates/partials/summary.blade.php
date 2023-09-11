<div class="row">

    <div class="col-md-4">
        <strong>Customer</strong>
    </div>
    <div class="col-md-8">
        <div class="form-group">

            <select name="customer_id" id="customer_id" class="form-control">
                <option value="">select Customer</option>
                @foreach ($customer as $cust)
                    <option {{ isset($estimate->customer_id) ? (old('customer_id', $estimate->customer_id) ? 'selected' : '') : '' }}
                     value="{{ $cust->id }}">{{ $cust->name }}</option>
                @endforeach
            </select>
            <span class="error-message error-messages" id="customer_id_error"></span><br>
        </div>
    </div>
    <!-- <div class="col-md-4">
            <div class="form-group">
                <button class="form-control"><i class="fas fa-link"></i> Link to parent</button>
            </div>
        </div> -->
</div>

<hr />
<div class="row">
    <div class="col-md-4">
        <strong>Main Contact</strong>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <input value="{{ isset($estimate->first_name) ? old('first_name', $estimate->first_name) : '' }}" class="form-control" name="first_name" id="first_name" placeholder="First Name">
            <span class="error-message error-messages" id="first_name_error"></span><br>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <input value="{{ isset($estimate->last_name) ? old('last_name', $estimate->last_name) : '' }}" class="form-control" name="last_name" id="last_name" placeholder="Last Name">
            <span class="error-message error-messages" id="last_name_error"></span><br>
        </div>
    </div>
</div>
@if (isset($estimate->prim_cont))

            @foreach ($estimate->prim_cont as $jobprim)
            <div >
                <div class="row">
                    <div class="col-md-4">
                        &nbsp;
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <input value="{{ isset($jobprim->phone) ? old('phone', $jobprim->phone) : '' }}" type="tel"  class="form-control" name="phone[]" id="" placeholder="Phone number">
                            <p class="error-message phone-error error-messages" style="display: none;"> Add at least phone </p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <input value="{{ isset($jobprim->ext) ? old('ext', $jobprim->ext) : '' }}" type="tel" class="form-control" name="ext[]" placeholder="Ext">
                            <p class="ext-error error-messages" style="display: none;">Add at least ext</p>
                        </div>

                    </div>

                </div>
            </div>
            <div >
                <div class="row">
                    <div class="col-md-4">&nbsp;</div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input value="{{ isset($jobprim->email) ? old('email', $jobprim->email) : '' }}" type="tel"
                                class="form-control" name="email[]" placeholder="Email">
                            <p class="email-error error-messages" style="display: none">Add at least email.</p>
                        </div>
                    </div>
                    <!-- Add a Remove button -->
                    @if (!$loop->last)
                    <div class="col-md-2">
                        <a href="{{route('estpri.destroy',$jobprim->id)}}"  class="btn"><i class="fas fa-trash text-danger"></i></a>
                    </div>
                    @else

                    <div class="col-md-2">
                        <button type="button" class="btn" id="add-primary"><i class="fas fa-plus text-primary"></i></button>
                    </div>
                    @endif

                </div>
            </div>
            @endforeach
        @else

<div >
    <div class="row">
        <div class="col-md-4">
            &nbsp;
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <input type="tel" class="form-control" name="phone[]" id="" placeholder="Phone number">
                <p class="error-message phone-error error-messages" style="display: none;"> Add at least phone </p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <input type="tel" class="form-control" name="ext[]" placeholder="Ext">
                <p class="ext-error error-messages" style="display: none;">Add at least ext</p>
            </div>

        </div>

    </div>
</div>
<div >
    <div class="row">
        <div class="col-md-4">&nbsp;</div>
        <div class="col-md-6">
            <div class="form-group">
                <input  type="tel"
                    class="form-control" name="email[]" placeholder="Email">
                <p class="email-error error-messages" style="display: none">Add at least email.</p>
            </div>
        </div>
        <!-- Add a Remove button -->
        <div class="col-md-2">
            <button type="button" class="btn" id="add-primary"><i class="fas fa-plus text-primary"></i></button>
        </div>

    </div>
</div>

@endif
<p class="primary_append">

</p>
<hr />
<div class="row">
    <div class="col-md-4">
        <strong>Service Location</strong>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <input value="{{ isset($estimate->location_name) ? old('location_name', $estimate->location_name) : '' }}"
                type="text" class="form-control" name="location_name"
                placeholder="Location Name(e.g Home or Office)">
        </div>
    </div>
    <div class="col-md-4">
        <input
        {{ isset($estimate->location_gated_property) && $estimate->location_gated_property ? 'checked' : '' }}
            type="checkbox" name="location_gated_property" placeholder="Location Name(e.g Home or Office)"> Gated
        Property
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        &nbsp;
    </div>
    <div class="col-md-5">
        <div class="form-group">
            <input value="{{ isset($estimate->location_address) ? old('location_address', $estimate->location_address) : '' }}"
                type="tel" class="form-control" name="location_address"
                placeholder="Street Address or Latitude Logitude">
        </div>
    </div>
    <div class="col-md-3">
        <input value="{{ isset($estimate->location_unit) ? old('location_unit', $estimate->location_unit) : '' }}" type="tel"
            class="form-control" name="location_unit" placeholder="Site/Unit/Apt">
    </div>
</div>
<div class="row">
    <div class="col-md-4">
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <input type="text"
                value="{{ isset($estimate->location_city) ? old('location_city', $estimate->location_city) : '' }}"
                class="form-control" name="location_city" placeholder="City">
        </div>
    </div>
    <div class="col-md-3">
        <input type="text"
            value="{{ isset($estimate->location_state) ? old('location_state', $estimate->location_state) : '' }}"
            class="form-control" name="location_state" placeholder="State/Province">
    </div>
    <div class="col-md-2">
        <input type="text"
            value="{{ isset($estimate->location_zipcode) ? old('location_zipcode', $estimate->location_zipcode) : '' }}"
            class="form-control" name="location_zipcode" placeholder="Zip/Postal Code">
    </div>
</div>
<hr />
<div class="row">
    <div class="col-md-4">
        <strong>Work Category</strong>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="jobCategory">Work Category</label>
            <select id="job-cat-id" name="job_cat_id" class="form-control">
                <option value="">Select a Work Category</option>
                @foreach ($jobCategories as $category)
                    <option {{ isset($estimate->job_cat_id) ? (old('job_cat_id', $estimate->job_cat_id) ? 'selected' : '') : '' }}
                     value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            <span class="error-message error-messages" id="job-cat-id_error"></span><br>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="jobSubcategory">Work Sub Category</label>
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
            <label for="jobSubDescription">Work Sub Description</label>
            <textarea id="jobSubDescription" name="job_sub_description" class="form-control"
                placeholder="Work Sub Category Description">{{ isset($estimate->job_sub_description) ? old('job_sub_description', $estimate->job_sub_description) : '' }}</textarea>
        </div>
    </div>
</div>
<hr />
<div class="row">
    <div class="col-md-4">
        <strong>Work Description</strong>
    </div>
    <div class="col-md-8">
        <div class="form-group">
            <textarea class="form-control" name="job_description" placeholder="Work Desciption">{{ isset($estimate->job_description) ? old('job_description', $estimate->job_description) : '' }}</textarea>
        </div>
    </div>
</div>
<hr />
<div class="row">
    <div class="col-md-4">
        <strong>PO #</strong>
    </div>
    <div class="col-md-8">
        <div class="form-group">
            <input value="{{ isset($estimate->po_no) ? old('po_no', $estimate->po_no) : '' }}" type="tel"
                class="form-control" name="po_no" placeholder="PO Number">
        </div>
    </div>
</div>
<hr />
<div class="row">
    <div class="col-md-4">
        <strong>Work Source</strong>
    </div>
    <div class="col-md-8">
        <div class="form-group">
            <select id="job_sour" name="job_source" class="form-control">
                <option value="">Select Work Source</option>
                @foreach ($job_source as $job_sour)
                    <option {{ isset($estimate->job_source) ? (old('job_source', $estimate->job_source) ? 'selected' : '') : '' }}
                     value="{{ $job_sour->id }}">{{ $job_sour->name }}</option>
                @endforeach
            </select>
            <span class="error-message error-messages" id="job_sour_error"></span><br>
        </div>
    </div>
</div>
<hr />
<div class="row">
    <div class="col-md-4">
        <strong>Representative</strong>
    </div>
    <div class="col-md-8">
        <div class="form-group">
            <select name="agent" id="agent" class="form-control">
                <option value="">select Agent</option>
                @foreach ($agent as $cust)
                    <option {{ isset($estimate->agent) ? (old('agent', $estimate->agent) ? 'selected' : '') : '' }}
                     value="{{ $cust->id }}">{{ $cust->name }}</option>
                @endforeach
            </select>
            <span class="error-message error-messages" id="customer_id_error"></span><br>
        </div>

    </div>
</div>
