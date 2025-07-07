@extends('frontend.layout.app')
@section('content')
    <!-----section-1----->
    <section>
        <div class="sec-1">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-6">
                        <div class="content">
                            <h1>Facilit8 System - Your Facility Managed Smarter</h1>
                            <p>Manage your entire facility business with effortless control, all under one roof. Get your
                                operations streamlined, your tasks simplified, and your efficiency enhanced with our
                                all-in-one management software solution.
                            </p>
                            <div class="btn">
                                <a href="#">Get in Touch</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-----section-2----->
        <div class="sec-2">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-3 col-md-3 col-lg-3">
                        <div class="img-1">
                            <img src="{{ asset('frontend/images/sdhsghrfghfg.png') }}">
                        </div>
                        <h4>On-Site Facility Assessments</h4>
                        <p>We provide on-time evaluations to assess maintenance needs, plan upgrades, or troubleshoot
                            issues, offering clients personalized solutions.</p>
                    </div>
                    <div class="col-12 col-sm-3 col-md-3 col-lg-3">
                        <div class="img-1">
                            <img src="{{ asset('frontend/images/sdfggfhd.png') }}">
                        </div>
                        <h4>Training and Consultation</h4>
                        <p>Our training sessions or consulting services help clients improve their facility management
                            processes, ensuring they can make the most of the software. </p>
                    </div>
                    <div class="col-12 col-sm-3 col-md-3 col-lg-3">
                        <div class="img-1">
                            <img src="{{ asset('frontend/images/sghsrhrt.png') }}">
                        </div>
                        <h4>Comprehensive Reporting and Insights</h4>
                        <p>To help you make data-driven decisions, we offer detailed reports on facility performance,
                            maintenance schedules, costs, and operational efficiency. </p>
                    </div>
                </div>
            </div>
        </div>
        <!-----section-3----->
        <div class="sec-3">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                        <h4>About Us</h4>
                        <h2>We Manage Your Facility Business Efficiently</h2>
                        <p>Welcome to Facilit8 System — where facility management gets a major upgrade! Founded by industry
                            veterans who understand the hustle and headaches of the service world, we’re on a mission to
                            make managing your facility business simpler, smarter, and more rewarding.</p>
                        <div class="pro-info">
                            <div class="icon">
                                <i class="fa fa-share-alt" aria-hidden="true"></i>
                            </div>
                            <div class="content-info">
                                <h5>Years Of Experience</h5>
                                <p>15+</p>
                            </div>
                        </div>

                        <div class="pro-info">
                            <div class="icon">
                                <i class="fa fa-user" aria-hidden="true"></i>
                            </div>
                            <div class="content-info">
                                <h5>Response Time:</h5>
                                <p>24/7 Support</p>
                            </div>
                        </div>
                        <div class="btn">
                            <a href="{{ route('about_us') }}">About Us</a>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                        <div class="image-2">
                            <img width="100%" src="frontend/images/Group-63-4.png">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-----section-4----->
        <div class="sec-4">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-8 col-md-8 col-lg-8">
                        <h3>Facilit8 System</h3>
                        <h1>Built by Experts, Designed for You</h1>
                        <p>Let's transform facility management with our intuitive solutions, which will simplify your tasks,
                            streamline processes, and empower your business to thrive.
                        </p>
                        <div class="btn">
                            <a href="{{ route('contactus') }}">Contact Us</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-----section-5----->
        <div class="sec-5">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                        <h4>Testimonial</h4>
                        <h2>Words Of Satisfaction</h2>
                        <div class="images-5">
                            <img width="100%" src="frontend/images/Group-66-2.png">
                        </div>
                    </div>
                    <div class="testi-main col-12 col-sm-12 col-md-8 col-lg-8">
                        <div class="owl-carousel testimonial-car owl-theme">
                            <div class="testi-inner">
                                <div class="upper1">
                                    <div>
                                        <img src="frontend/images/Ellipse-4-2.png" alt="">
                                    </div>
                                    <div>
                                        <h6>Phillip Maxwell</h6>
                                        {{-- <p>Painting and Finishing For Mill</p> --}}
                                    </div>
                                </div>
                                <p class="resti-para">
                                    From coordinating subcontractors to tracking jobs in real time, everything runs smoother
                                    and faster. Our team saves hours every week, allowing us to focus on delivering great
                                    service to our clients.
                                </p>
                            </div>

                            <div class="testi-inner">
                                <div class="upper1">
                                    <div>
                                        <img width="100px" src="frontend/images/headshot-girl-smiling.png" alt="">
                                    </div>
                                    <div>
                                        <h6>John Osgood</h6>
                                        {{-- <p>Rust Stop Treatment For Terrace </p> --}}
                                    </div>
                                </div>
                                <p class="testi-para">

                                    It’s incredibly user-friendly, and the customer support team is always available to
                                    help. We’ve reduced our admin time by 30% since using this software—it’s a
                                    game-changer!”
                                </p>
                            </div>

                            <div class="testi-inner">
                                <div class="upper1">
                                    <div>
                                        <img width="100px" src="frontend/images/manlook.png" alt="">
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
            <!-----section-6----->
            <div class="sec-6">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="content-3">
                                <h2>All-In-One Facility Management Software
                                </h2>
                                <p>See what we have in store for you! </p>
                            </div>
                        </div>
                        <div class="col-12 col-sm-4 col-md-4 col-lg-4">
                            <div class="images-3">
                                <img width="100%" src="frontend/images/image-2024-08-19T180503.011.png">
                            </div>
                            <h5>Job Scheduling & Dispatching</h5>
                            <p>Easily schedule and dispatch tasks to subcontractors and employees, ensuring timely service
                                delivery.</p>
                        </div>
                        <div class="col-12 col-sm-4 col-md-4 col-lg-4">
                            <div class="images-3">
                                <img width="100%" src="frontend/images/image-2024-08-19T180429.918.png">
                            </div>
                            <h5>Real-Time Job Tracking</h5>
                            <p>Track the progress of jobs in real time to stay updated on task completion and service
                                status.</p>
                        </div>
                        <div class="col-12 col-sm-4 col-md-4 col-lg-4">
                            <div class="images-2">
                                <img width="100%" src="frontend/images/image-2024-08-19T180433.686.png">
                            </div>
                            <h5>Automated Reminders & Alerts</h5>
                            <p>Send automatic reminders for upcoming tasks, appointments, or service due dates, reducing
                                no-shows.</p>
                        </div>
                        <div class="btn">
                            <a href="{{ route('service') }}">Explore Our Services</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-----section-7----->
            <div class="sec-7">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                            <h2>Find Us Here!</h2>
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4400.741146836249!2d-90.04144914165491!3d35.14695242321589!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x87d57f64e0678647%3A0xad453f0450885857!2sManassas%20Garden!5e0!3m2!1sen!2s!4v1726178910707!5m2!1sen!2s"
                                width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                            <div class="images-4">
                                <img width="25%" src="frontend/images/image-2024-08-19T185437.173.png">
                                <img width="25%" src="frontend/images/image-2024-08-19T185426.178-1.png">
                                <img width="25%" src="frontend/images/image-2024-08-19T185426.178.png">
                            </div>
                        </div>
                        <!-- <div class="col-12 col-sm-4 col-md-4 col-lg-4">
                            <h2>Map Location</h2>
                            <p>Track the phone number’s location on Google Maps by opening the app on the associated device.
                            </p>
                            <ul>
                                <li>Mississippi</li>
                                <li>Tennessee</li>
                                <li>Arkansas</li>
                                <li>Kentucky</li>
                                <li>Oklahoma</li>
                                <li>Kansas</li>
                            </ul>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
