@extends('admin.layouts.app')


@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
             <div class="div-a">
				 <h2 class="a1" style="font-size: 24px;">Add New Customer</h2>
				 <p class="a2">create a new customer account</p>
			  </div>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add New Customer</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
    <div class="container-fluid">
    @if (count($errors) > 0)
  <div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
       @foreach ($errors->all() as $error)
         <li>{{ $error }}</li>
       @endforeach
    </ul>
  </div>
@endif
        <div class="row">
          <div class="col-12">
              <div class="card">
                  <div class="card-header">
                  <form action="#" method="POST">
            <div class="inner-section py-3">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="div-a">
                                
                            </div>
                        </div>
                        <div class="col-sm-6 float-1">
                            <button type="submit" class="add-new">Save</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="inner-section-2">
                <div class="container">
                    <div class="form-div">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="mb-3">
                                    <label for="exampleInputcustomer" class="form-label">Customer</label>
                                    <input type="text" class="form-control" id="exampleInputcustomer" placeholder="Customer Name">
                                </div>
                            </div>
                         
                            
                            <div class="col-sm-3">
                                <div class="mb-3">
                                    <label for="flexRadioDefault3" class="form-label">Service Agreement ?</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault1"
                                            id="flexRadioDefault3" checked>
                                        <label class="form-check-label" for="flexRadioDefault3">
                                            Yes
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault1"
                                            id="flexRadioDefault4">
                                        <label class="form-check-label" for="flexRadioDefault4">
                                            No
                                        </label>
                                    </div>
                                </div>
                            </div>
							<div class="col-sm-3">
                                <div class="mb-3">
                                    <label for="exampleInputacount" class="form-label">Account #</label>
                                    <input type="number" class="form-control" id="exampleInputaccount" placeholder="Account number">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="mb-3">
                                    <label for="flexRadioDefault5" class="form-label">Active ?</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault2"
                                            id="flexRadioDefault5" checked>
                                        <label class="form-check-label" for="flexRadioDefault5">
                                            Yes
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault2"
                                            id="flexRadioDefault6">
                                        <label class="form-check-label" for="flexRadioDefault6">
                                            No
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="inner-header bg-light pt-2 pb-2">
                                    <h3 class="primary">Primary Contact</h3>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="name-main-div">
                                    
                                    <div class="mb-3">
                                        <label for="exampleInputfirst" class="form-label">First Name</label>
                                        <input type="text" class="form-control" id="exampleInputfirst" placeholder="First Name">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputlast" class="form-label">Last Name</label>
                                        <input type="text" class="form-control" id="exampleInputlast" placeholder="Last Name">
                                    </div>
                                   
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="phone-main-div">
                                    <div class="col-md-4">
                                        <label for="number-div" class="form-label">Phone</label>
                                        <select class="form-select form-control" aria-label="Default select example" id="number-div" >
                                            <option value="">Select Menu</option>
											<option value="1">Mobile</option>
                                            <option value="2">Telephone</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" id="number-div" placeholder="433202232323">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" id="number-div" placeholder="Ext">
                                    </div>
                                    <div class="col-md-2">
                                        <button class="add-sign">&#43;</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="mb-3">
                                    <label for="exampleInputdepartment" class="form-label">Department</label>
                                    <input type="text" class="form-control" id="exampleInputdepartment" placeholder="Department">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="mb-3">
                                    <label for="exampleInputjob" class="form-label">Job Title</label>
                                    <input type="text" class="form-control" id="exampleInputjob" placeholder="Job title">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="email-address-div">
                                    <div class="col-md-4">
                                        <label for="email-div" class="form-label">Email</label>
                                        <select class="form-select form-control" aria-label="Default select example" id="email-div">
                                            <option value="1">Personal</option>
                                            <option value="2">Company</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" id="number-div" placeholder="abc@gmail.com">
                                    </div>
                                    <div class="col-md-2">
                                        <button class="add-sign">&#9881;</button>
                                    </div>
                                    <div class="mb-2">
                                        <button class="add-sign">&#43;</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-2 align-items-end">
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefaultc"
                                            id="flexRadioDefault5" checked>
                                        <label class="form-check-label" for="flexRadioDefaultc">
                                            Billing Contact
                                        </label>
										
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefaultc"
                                            id="flexRadioDefaultc">
                                        <label class="form-check-label" for="flexRadioDefaultc">
                                            Booking Contact
                                        </label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-sm-6"></div>
                            <div class="col-sm-12">
                                <div class="inner-header bg-light pt-2 pb-2">
                                    <h3 class="primary">Stored Service</h3>
                                    <button class="add-more-btn">&#43;Add Another Service</button>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="mb-3">
                                    <label for="exampleInputlocation" class="form-label">Nickname</label>
                                    <input type="text" class="form-control" id="exampleInputlocation" placeholder="David Smith">
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="mb-3">
                                    <label for="flexRadioDefaulta" class="form-label">Primary?</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefaulta"
                                            id="flexRadioDefaulta" checked>
                                        <label class="form-check-label" for="flexRadioDefaulta">
                                            Yes
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefaulta"
                                            id="flexRadioDefaultb">
                                        <label class="form-check-label" for="flexRadioDefaultb">
                                            No
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="mb-3">
                                    <label for="flexRadioDefaultd" cldss="form-label">Billing Address?</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefaultd"
                                            id="flexRadioDefaultd" checked>
                                        <label class="form-check-label" for="flexRadioDefaultd">
                                            Yes
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefaultd"
                                            id="flexRadioDefaultd">
                                        <label class="form-check-label" for="flexRadioDefaultd">
                                            No
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="mb-3">
                                    <label for="email-div" class="form-label">Contact</label>
                                    <select class="form-select form-control" aria-label="Default select example" id="email-div">
                                        <option value="0" disabled>Select Contact</option>
                                        <option value="1">contact 1</option>
                                        <option value="2">contact 2</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="mb-3">
                                    <label for="flexRadioDefaulte" cldss="form-label">Active?</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefaulte"
                                            id="flexRadioDefaulte" checked>
                                        <label class="form-check-label" for="flexRadioDefaulte">
                                            Yes
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefaulte"
                                            id="flexRadioDefaulte">
                                        <label class="form-check-label" for="flexRadioDefaulte">
                                            No
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="location-div">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="mb-3">
                                                <label for="exampleInputstreet" class="form-label">Street Address or
                                                    Latitude, Longitude</label>
                                                <input type="text" class="form-control" id="exampleInputstreet" placeholder="Street Address or Latitude, Longitude">
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="mb-3">
                                                <label for="exampleInputapt" class="form-label">Apt/Suite/Unit #</label>
                                                <input type="text" class="form-control" id="exampleInputapt" placeholder="Apt Suite Unit #">
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="mb-3">
                                                <label for="exampleInputcity" class="form-label">City</label>
                                                <input type="text" class="form-control" id="exampleInputcity" placeholder="City Name">
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="mb-3">
                                                <label for="exampleInputstate" class="form-label">State/Province</label>
                                                <input type="text" class="form-control" id="exampleInputstate" placeholder="State Province">
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="mb-3">
                                                <label for="exampleInputzip" class="form-label">Zip/Postal Code</label>
                                                <input type="text" class="form-control" id="exampleInputzip" placeholder="Zip Postal Code">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="inner-header bg-light pt-2 pb-2">
                                    <h3 class="primary">Default Document Templates</h3>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="estimate-div" class="form-label">Estimate Template</label>
                                    <select class="form-select form-control" aria-label="Default select example" id="estimate-div">
                                        <option value="1">Default</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="job-div" class="form-label">Job/Work Order Template</label>
                                    <select class="form-select form-control" aria-label="Default select example" id="job-div">
                                        <option value="1">Default</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="invoice-div" class="form-label">Invoice Template</label>
                                    <select class="form-select form-control" aria-label="Default select example" id="invoice-div">
                                        <option value="1">Default</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="inner-header bg-light pt-2 pb-2">
                                    <h3 class="primary">Additional Information</h3>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <label for="notes-div" class="form-label ">Internal/Private Notes</label>
                                <textarea class="text-area w-100 form-control" rows="8" id="notes-div" placeholder="Internal/Private Notes"></textarea>
                                
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="exampleInputcustomertag" class="form-label">Customer Tags</label>
                                    <input type="text" class="form-control" id="exampleInputcustomertag" placeholder="Customer Tags">
                                </div>
                                <div class="mb-3">
                                    <label for="referral-div form-control" class="form-label">Referral Source</label>
                                    <select class="form-select form-control" aria-label="Default select example" id="referral-div">
                                        <option value="1">Referral 1</option>
                                        <option value="2">Referral 2</option>
                                    </select>
                                </div>
                                
                                
                                <div class="mb-3">
                                    <label for="exampleInputamount" class="form-label">Amount</label>
                                    <input type="text" class="form-control" id="exampleInputamount" placeholder="Amount">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="referral-div" class="form-label">Assigned Contract</label>
                                    <select class="form-select form-control" aria-label="Default select example" id="referral-div">
                                        <option value="1">Contract 1</option>
                                        <option value="2">Contract 2</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="flexRadioDefaulttax" class="form-label">Taxable?</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefaulttax"
                                            id="flexRadioDefaulttax" checked>
                                        <label class="form-check-label" for="flexRadioDefaulttax">
                                            Yes
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefaulttax"
                                            id="flexRadioDefaulttax">
                                        <label class="form-check-label" for="flexRadioDefaulttax">
                                            No
                                        </label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="item-div" class="form-label">Tax Item</label>
                                    <select class="form-select form-control" aria-label="Default select example" id="item-div">
                                        <option value="1">Tax 1</option>
                                        <option value="2">Tax 2</option>
                                    </select>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="exampleInputnumber" class="form-label">Business # & Tax ID</label>
                                    <input type="text" class="form-control" id="exampleInputnumber" placeholder="Business # & Tax ID">
                                </div>
                                <div class="agent-inner-div">
                                    <div class="commission-div">
                                        <label for="agent-div" class="form-label">Assigned Rep</label>
                                        <select class="form-select form-control" aria-label="Default select example" id="agent-div">
                                            <option value="1">Do Not Assign Agent/Rep</option>
                                        </select>
                                    </div>
                                    <div class="commission1-div">
                                        <label for="commission-div" class="form-label">Commission</label>
                                        <select class="form-select form-control" aria-label="Default select example"
                                            id="commission-div">
                                            <option value="1">%</option>
                                        </select>
                                    </div>
                                    <div class="commission2-div">
                                        <input type="text" class="form-control" id="exampleInputcommtag">
                                    </div>
                                    <div class="commission3-div">
                                        <button class="add-sign">+</button>
                                    </div>
                                </div>
                            </div>
                            <div class="bottom-button">
                                <button class="save-customer-btn">Save Customer Account</button>
                                <button class="cancel-customer-btn">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
                  </div>
              </div> 
          </div>   
        </div>
    </div>
</section>

</div>

@endsection

