@extends('frontend.layout.app')
@section('content')
    <!-----heading----->
    <div class="heading">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                    <h2>About Usss</h2>
                </div>
            </div>
        </div>
    </div>
    <!-----sec-3-aboutus----->
    <div class="sec-3 aboutus">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                    <h4>About Us</h4>
                    <h2>We Manage Your Facility Business Efficiently </h2>
                    <p>
                        Welcome to Pedro Grillo — where facility management gets a major upgrade! Founded by industry
                        veterans who understand the hustle and headaches of the service world, we’re on a mission to make
                        managing your facility business simpler, smarter, and more rewarding. After 15 years of rolling up
                        our sleeves in the service industry, we realized there had to be a better way. So we built it! Pedro
                        Grillo is the software we wish we’d had—an all-in-one, subscription-based solution designed for
                        facility managers like you, who need everything in one place without the extra fuss.
                        <br><br>
                        Imagine handling your entire operation from a single dashboard. This is what we do; with us, you can
                        easily schedule jobs, dispatch teams, and track progress in real-time, manage subcontractors with a
                        few clicks—plumbers, landscapers, electricians, you name it, and simplify invoicing and payments for
                        smooth, streamlined billing. With Pedro Grillo, it’s all about effortless control and keeping things
                        moving seamlessly. Whether it’s daily maintenance or long-term planning, our platform lets you
                        manage every detail under one roof so nothing falls through the cracks.

                    </p>

                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                    <div class="image-2">
                        <img width="100%" src="{{ asset('frontend/images/Group-63-4.png') }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-----sec-5-aboutus----->
    <div class="sec-5 aboutus">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-4 col-md-4 col-lg-4">
                    <h4>Testimonial</h4>
                    <h2>Words Of Satisfaction</h2>
                    <div class="images-5">
                        <img width="100%" src="{{ asset('frontend/images/Group-66-2.png') }}">
                    </div>
                </div>
                <div class="testi-main col-12 col-sm-8 col-md-8 col-lg-8">
                    <div class="owl-carousel owl-theme">
                        <div class="testi-inner">
                            <div class="upper1">
                                <div>
                                    <img src="{{ asset('frontend/images/Ellipse-4-2.png') }}" alt="">
                                </div>
                                <div>
                                    <h6>Phillip Maxwell</h6>
                                    {{-- <p>Painting and Finishing For Mill</p> --}}
                                </div>
                            </div>
                            <p class="resti-para">
                                From coordinating subcontractors to tracking jobs in real time, everything runs smoother and
                                faster. Our team saves hours every week, allowing us to focus on delivering great service to
                                our clients.
                            </p>
                        </div>

                        <div class="testi-inner">
                            <div class="upper1">
                                <div>
                                    <img width="100px" src="{{ asset('frontend/images/headshot-girl-smiling.png') }}"
                                        alt="">
                                </div>
                                <div>
                                    <h6>John Osgood</h6>
                                    {{-- <p>Rust Stop Treatment For Terrace </p> --}}
                                </div>
                            </div>
                            <p class="testi-para">
                                It’s incredibly user-friendly, and the customer support team is always available to help.
                                We’ve reduced our admin time by 30% since using this software—it’s a game-changer!”
                            </p>
                        </div>

                        <div class="testi-inner">
                            <div class="upper1">
                                <div>
                                    <img width="100px" src="{{ asset('frontend/images/manlook.png') }}" alt="">
                                </div>
                                <div>
                                    <h6>Helen Lopez</h6>
                                    {{-- <p>Airless Spray For Garage </p> --}}
                                </div>
                            </div>
                            <p class="testi-para">
                                The software is powerful yet easy to use, and it covers everything we need for facility
                                management. Scheduling, invoicing, and reporting are all in one place.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
