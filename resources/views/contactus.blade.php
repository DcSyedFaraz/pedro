@extends('frontend.layout.app')
@section('content')
<!-----sec-10----->
<div class="sec-10">
    <div class="container">
        <div class="row">
            <form class="my-form">
                <div class="container">
                    <h1>Get in touch!</h1>
                    <ul>
                        <li>
                            <p>FIll out the form below and we will cantact you as soon as possible</p>
                        </li>
                        <li>
                            <div class="grid grid-2">
                                <input type="text" placeholder="Name" required>
                                <input type="text" placeholder="Email" required>
                            </div>
                        </li>
                        <li>
                            <div class="grid grid-2">
                                <input type="email" placeholder="Contact number" required>
                                <input type="tel" placeholder="Address (street no, area, city)">
                            </div>
                        </li>
                        <li>
                            <select>
                                <option selected disabled>-- Please choose an option --</option>
                                <option>1. Grain Bins & Legs</option>
                                <option>2. Morton Buildings</option>
                                <option>3. Rubberized Roof Coatings</option>
                                <option>4. Elastomeric Leak Stop</option>
                                <option>5. Pressure Washing</option>
                                <option>6. Rust Stop</option>
                                <option>7. Custom Color Matching</option>
                                <option>8. Airless Spray Equipment</option>
                                <option>9. Grain Bin Sealant</option>
                                <option>10. Fondation Sealant</option>
                                <option>11. Hot Pour Rubber</option>
                                <option>12. Skylight Repair-Replace</option>
                                <option>13. Farm</option>
                                <option>14. Commercial</option>
                                <option>15. Residential</option>
                                <option>16. Industrial</option>
                                <option>17. Free Estimates</option>
                                <option>18. Fully Insured</option>
                                <option>19. All Work Guaranteed</option>
                            </select>
                        </li>
                        <li>
                            <textarea placeholder="Message"></textarea>
                        </li>
                        <div class="grid grid-3">
                            <button class="btn-grid" type="submit" disabled>
                                <span class="btn-3">SUBMIT</span>
                            </button>
                        </div>
                        </li>
                    </ul>
                </div>
            </form>
        </div>
        <div class="row">
            <div class="col-12 col-sm-4 col-md-4 col-lg-4">
                <div class="box">
                    <h5>Address</h5>
                    <p>1714 N Goldenrod Road, A4, Orlando FL 32807</p>
                </div>
            </div>
            <div class="col-12 col-sm-4 col-md-4 col-lg-4">
                <div class="box">
                    <h5>Phone</h5>
                    <p>407-978-0288</p>
                </div>
            </div>
            <div class="col-12 col-sm-4 col-md-4 col-lg-4">
                <div class="box">
                    <h5>Email</h5>
                    <p>info@facilit8system.com</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="sec-11">
    <div class="">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7007.944334109951!2d-81.29040842471983!3d28.570598486891072!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x88e76584fe5677a3%3A0x90bef6a8d8fda737!2s1714%20N%20Goldenrod%20Rd%2C%20Orlando%2C%20FL%2032807%2C%20USA!5e0!3m2!1sen!2s!4v1751562686797!5m2!1sen!2s"
                    width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
</div>
@endsection