@extends(Auth::user()->hasRole('Admin') ? 'admin.layouts.app' : 'manager.layouts.app')



@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Create New Technicians</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Create New Technicians</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <form action="{{ route('technicians.store') }}" method="POST">
                                    @csrf
                                    <div class="col-sm-12">
                                        {{-- <div class="inner-header bg-light pt-2 pb-2">
                                            <h3 class="primary">Primary Contact</h3>
                                            <button class="add-more-btn" id="add-pri" type="button">&#43;Add Primary
                                                Contact</button>
                                        </div> --}}
                                    </div>
                                    <div class="pri_append" id="pri_div">

                                        <div class="row">

                                            <div class="col-sm-6">
                                                <div class="name-main-div">

                                                    <div class="mb-3">
                                                        <label for="exampleInputfirst" class="form-label">First
                                                            Name</label>
                                                        <input type="text" name="fname" class="form-control"
                                                            id="exampleInputfirst" placeholder="First Name">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleInputlast" class="form-label">Last
                                                            Name</label>
                                                        <input type="text" name="lname" class="form-control"
                                                            id="exampleInputlast" placeholder="Last Name">
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="phone-main-div">
                                                    <div class="col-md-4">
                                                        <label for="number-div" class="form-label">Phone</label>
                                                        <select class="form-select form-control" name="phone_type"
                                                            aria-label="Default select example" id="number-div">
                                                            <option value="">Select Menu</option>
                                                            <option value="mobile">Mobile</option>
                                                            <option value="telephone">Telephone</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="text" name="number" class="form-control"
                                                            id="number-div" placeholder="433202232323">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <input type="text" name="ext" class="form-control"
                                                            id="number-div" placeholder="Ext">
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class="col-sm-3">
                                                <div class="mb-3">
                                                    <label for="exampleInputdepartment"
                                                        class="form-label">Department</label>
                                                    <input type="text" name="department" class="form-control"
                                                        id="exampleInputdepartment" placeholder="Department">
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="mb-3">
                                                    <label for="exampleInputjob" class="form-label">Job
                                                        Title</label>
                                                    <input type="text" name="job_title" class="form-control"
                                                        id="exampleInputjob" placeholder="Job title">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="email-address-div">
                                                    <div class="col-md-4">
                                                        <label for="email-div" class="form-label">Email</label>
                                                        <select class="form-select form-control" name="email_type"
                                                            aria-label="Default select example" id="email-div">
                                                            <option value="personal">Personal</option>
                                                            <option value="company">Company</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="text" class="form-control" name="email"
                                                            id="number-div" placeholder="abc@gmail.com">
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="" class="row mt-3">


                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="flexRadioDefaultd" cldss="form-label">Billing
                                                    Address?</label>
                                                <select class="form-select form-control"
                                                    name="billing_address"
                                                    aria-label="Default select example">
                                                    <option value="yes">Yes</option>
                                                    <option value="no">No</option>
                                                </select>

                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="mb-3">
                                                <label for="email-div" class="form-label">Contact</label>
                                                <select class="form-select form-control" name="contact_type"
                                                    aria-label="Default select example">
                                                    <option value="0" disabled>Select Contact</option>
                                                    <option value="contact 1">contact 1</option>
                                                    <option value="contact 2">contact 2</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="mb-3">
                                                <label for="flexRadioDefaulte"
                                                    cldss="form-label">Active?</label>
                                                <select class="form-select form-control"
                                                    name="active"
                                                    aria-label="Default select example">
                                                    <option value="yes">Yes</option>
                                                    <option value="no">No</option>
                                                </select>

                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="location-div">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div class="mb-3">
                                                            <label for="exampleInputstreet"
                                                                class="form-label">Street Address or
                                                                Latitude, Longitude</label>
                                                            <input type="text" name="address"
                                                                class="form-control" id="exampleInputstreet"
                                                                placeholder="Street Address or Latitude, Longitude">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <div class="mb-3">
                                                            <label for="exampleInputapt"
                                                                class="form-label">Apt/Suite/Unit #</label>
                                                            <input type="text" name="aptNo"
                                                                class="form-control" id="exampleInputapt"
                                                                placeholder="Apt Suite Unit #">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <div class="mb-3">
                                                            <label for="exampleInputcity"
                                                                class="form-label">City</label>
                                                            <input type="text" name="city"
                                                                class="form-control" id="exampleInputcity"
                                                                placeholder="City Name">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <div class="mb-3">
                                                            <label for="exampleInputstate"
                                                                class="form-label">State/Province</label>
                                                            <input type="text" name="state"
                                                                class="form-control" id="exampleInputstate"
                                                                placeholder="State Province">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <div class="mb-3">
                                                            <label for="exampleInputzip"
                                                                class="form-label">Zip/Postal Code</label>
                                                            <input type="text" name="zip"
                                                                class="form-control" id="exampleInputzip"
                                                                placeholder="Zip Postal Code">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <button type="submit" class="btn btn-primary">Submit</button>
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
