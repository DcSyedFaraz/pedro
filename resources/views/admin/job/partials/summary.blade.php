<div class="row">

    <div class="col-md-4">
        <strong>{{ __('admin/job/edit.customer') }}</strong>
    </div>
    <div class="col-md-8">
        <div class="form-group">

            <select name="customer_id" id="customer_id" class="form-control">
                <option value="">Select {{ __('admin/job/edit.customer') }}</option>
                @foreach ($customer as $cust)
                    <option value="{{ $cust->id }}"
                        {{ isset($job) && old('customer_id', $job->customer_id) == $cust->id ? 'selected' : '' }}>
                        {{ $cust->name }}
                    </option>
                @endforeach
            </select>

            <span class="error-message error-messages" id="customer_id_error"></span><br>
        </div>
    </div>
    <div class="col-md-4">
        <strong>{{ __('admin/job/edit.job_name') }}</strong>
    </div>
    <div class="col-md-8">
        <div class="form-group">

            <input value="{{ isset($job->name) ? old('name', $job->name) : '' }}" class="form-control" name="name"
                id="name" placeholder="Job Name">

            <span class="error-message error-messages" id="customer_id_error"></span><br>
        </div>
    </div>

</div>

<hr />
<div class="row">
    <div class="col-md-4">
        <strong>{{ __('admin/job/edit.primary_contact') }}</strong>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <input value="{{ isset($job->first_name) ? old('first_name', $job->first_name) : '' }}" class="form-control"
                name="first_name" id="first_name" placeholder="First Name">
            <span class="error-message error-messages" id="first_name_error"></span><br>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <input value="{{ isset($job->last_name) ? old('last_name', $job->last_name) : '' }}" class="form-control"
                name="last_name" id="last_name" placeholder="Last Name">
            <span class="error-message error-messages" id="last_name_error"></span><br>
        </div>
    </div>
</div>
@if (isset($job->jobPri))

    @foreach ($job->jobPri as $jobprim)
        <div class="primary_append">
            <div class="row">
                <div class="col-md-4">
                    &nbsp;
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <input value="{{ isset($jobprim->phone) ? old('phone', $jobprim->phone) : '' }}" type="tel"
                            class="form-control" name="phone[]" id="" placeholder="Phone number">
                        <p class="error-message phone-error error-messages" style="display: none;"> {{ __('admin/job/edit.add_at_least_phone') }}
                        </p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <input value="{{ isset($jobprim->ext) ? old('ext', $jobprim->ext) : '' }}" type="tel"
                            class="form-control" name="ext[]" placeholder="Ext">
                        <p class="ext-error error-messages" style="display: none;">{{ __('admin/job/edit.add_at_least_ext') }}</p>
                    </div>

                </div>

            </div>
        </div>
        <div class="email_append">
            <div class="row">
                <div class="col-md-4">&nbsp;</div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input value="{{ isset($jobprim->email) ? old('email', $jobprim->email) : '' }}" type="tel"
                            class="form-control" name="email[]" placeholder="Email">
                        <p class="email-error error-messages" style="display: none">{{ __('admin/job/edit.add_at_least_email') }}</p>
                    </div>
                </div>
                <!-- Add a Remove button -->
                @if (!$loop->last)
                    <div class="col-md-2">
                        <a href="{{ route('jobpri.destroy', $jobprim->id) }}" class="btn"><i
                                class="fas fa-trash text-danger"></i></a>
                    </div>
                @else
                    <div class="col-md-2">
                        <button type="button" class="btn" id="add-email"><i
                                class="fas fa-plus text-primary"></i></button>
                    </div>
                @endif

            </div>
        </div>
    @endforeach
@else
    <div>
        <div class="row">
            <div class="col-md-4">
                &nbsp;
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <input type="tel" class="form-control" name="phone[]" id="" placeholder="Phone number">
                    <small class="text-danger text-wrap">{{ __('admin/job/edit.job_info') }}</small>
                    <p class="error-message phone-error error-messages" style="display: none;"> {{ __('admin/job/edit.add_at_least_phone') }} </p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <input type="tel" class="form-control" name="ext[]" placeholder="Ext">
                    <p class="ext-error error-messages" style="display: none;">{{ __('admin/job/edit.add_at_least_ext') }}</p>
                </div>

            </div>

        </div>
    </div>
    <div>
        <div class="row">
            <div class="col-md-4">&nbsp;</div>
            <div class="col-md-6">
                <div class="form-group">
                    <input type="tel" class="form-control" name="email[]" placeholder="Email">
                    <p class="email-error error-messages" style="display: none">{{ __('admin/job/edit.add_at_least_email') }}</p>
                </div>
            </div>
            <!-- Add a Remove button -->
            <div class="col-md-2">
                <button type="button" class="btn" id="add-primary"><i
                        class="fas fa-plus text-primary"></i></button>
            </div>

        </div>
    </div>

@endif
<p class="primary_append">

</p>
<hr />
<div class="row">
    <div class="col-md-4">
        <strong>{{ __('admin/job/edit.service_location') }}</strong>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <input value="{{ isset($job->location_name) ? old('location_name', $job->location_name) : '' }}"
                type="text" class="form-control" name="location_name"
                placeholder="Location Name(e.g Home or Office)">
        </div>
    </div>
    <div class="col-md-4">
        <input {{ isset($job->location_gated_property) && $job->location_gated_property ? 'checked' : '' }}
            type="checkbox" name="location_gated_property" placeholder="Location Name(e.g Home or Office)"> {{ __('admin/job/edit.gated_property') }}
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        &nbsp;
    </div>
    <div class="col-md-5">
        <div class="form-group">
            <input value="{{ isset($job->location_address) ? old('location_address', $job->location_address) : '' }}"
                type="tel" class="form-control" name="location_address"
                placeholder="Street Address or Latitude Logitude">
        </div>
    </div>
    <div class="col-md-3">
        <input value="{{ isset($job->location_unit) ? old('location_unit', $job->location_unit) : '' }}"
            type="tel" class="form-control" name="location_unit" placeholder="Site/Unit/Apt">
    </div>
</div>
<div class="row">
    <div class="col-md-4">
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <input type="text"
                value="{{ isset($job->location_city) ? old('location_city', $job->location_city) : '' }}"
                class="form-control" name="location_city" placeholder="City">
        </div>
    </div>
    <div class="col-md-3">
        <input type="text"
            value="{{ isset($job->location_state) ? old('location_state', $job->location_state) : '' }}"
            class="form-control" name="location_state" placeholder="State/Province">
    </div>
    <div class="col-md-2">
        <input type="text"
            value="{{ isset($job->location_zipcode) ? old('location_zipcode', $job->location_zipcode) : '' }}"
            class="form-control" name="location_zipcode" placeholder="Zip/Postal Code">
    </div>
</div>
<hr />
<div class="row">
    <div class="col-md-4">
        <strong>{{ __('admin/job/edit.job_category') }}</strong>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="jobCategory">{{ __('admin/job/edit.job_category') }}</label>
            <select id="job-cat-id" name="job_cat_id" class="form-control">
                <option value="">Select a {{ __('admin/job/edit.job_category') }}</option>
                @foreach ($jobCategories as $category)
                    <option
                        {{ isset($job->job_cat_id) ? (old('job_cat_id', $job->job_cat_id) ? 'selected' : '') : '' }}
                        value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            <span class="error-message error-messages" id="job-cat-id_error"></span><br>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="showDescription">Job Sub Category</label>
            <input type="checkbox" {{ isset($job->job_sub_cat_id) && $job->job_sub_cat_id ? 'checked' : '' }}
                id="showDescription" name="job_sub_cat_id" class="form-control form-control-sm form-check">
            {{-- <select id="jobSubcategory" name="job_sub_cat_id" class="form-control">
                <option value="">Select a job subcategory</option>
            </select> --}}
            <span class="error-message error-messages" id="jobSubcategory_error"></span><br>
        </div>
    </div>

</div>
<div class="row" id="descriptionContainer"
    style="{{ isset($job->job_sub_cat_id) && $job->job_sub_cat_id ? '' : 'display: none;' }}">
    <div class="col-md-4">
        <strong>&nbsp;</strong>
    </div>
    <div class="col-md-8">
        <div class="form-group">
            <label for="jobSubDescription">Job Sub Description</label>
            <textarea id="jobSubDescription" name="job_sub_description" class="form-control"
                placeholder="Job Sub Category Description">{{ isset($job->job_sub_description) ? old('job_sub_description', $job->job_sub_description) : '' }}</textarea>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <strong>{{ __('admin/job/edit.job_description') }}</strong>
    </div>
    <div class="col-md-8">
        <div class="form-group">
            <textarea class="form-control" name="job_description" placeholder="Job Desciption">{{ isset($job->job_description) ? old('job_description', $job->job_description) : '' }}</textarea>
        </div>
    </div>
</div>
<hr />
<div class="row">
    <div class="col-md-4">
        <strong>{{ __('admin/job/edit.po_number') }}</strong>
    </div>
    <div class="col-md-8">
        <div class="form-group">
            <input value="{{ isset($job->po_no) ? old('po_no', $job->po_no) : '' }}" type="tel"
                class="form-control" name="po_no" placeholder="PO Number">
        </div>
    </div>
</div>
<hr />
<div class="row">
    <div class="col-md-4">
        <strong>{{ __('admin/job/edit.job_source') }}</strong>
    </div>
    <div class="col-md-8">
        <div class="form-group">
            <select id="job_sour" name="job_source" class="form-control">
                <option value="">Select {{ __('admin/job/edit.job_source') }}</option>
                @foreach ($job_source as $job_sour)
                    <option
                        {{ isset($job->job_source) ? (old('job_source', $job->job_source) ? 'selected' : '') : '' }}
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
        <strong>{{ __('admin/job/edit.agent_rep') }}</strong>
    </div>
    <div class="col-md-8">
        <div class="form-group">
            <select name="agent" id="agent" class="form-control">
                <option value="">select {{ __('admin/job/edit.agent_rep') }}</option>
                @foreach ($agent as $cust)
                    <option {{ isset($job->agent) ? (old('agent', $job->agent) ? 'selected' : '') : '' }}
                        value="{{ $cust->id }}">{{ $cust->name }}</option>
                @endforeach
            </select>
            <span class="error-message error-messages" id="customer_id_error"></span><br>
        </div>

    </div>
</div>
<div class="row">
    <div class="form-group">
        <label for="showBill">{{ __('admin/job/edit.billable') }}</label>
        <input type="checkbox" {{ isset($job->billable) && $job->billable ? 'checked' : '' }} id="showBill"
            name="billable" class="form-control form-control-sm form-check">
    </div>
</div>
