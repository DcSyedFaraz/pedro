<!DOCTYPE html>
<html lang="en">
<head>
    <title>Pedro</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/style.css') }}" />
    <!-- //////////SLICK_SLIDER/////////// -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css"/>

</head>
<body>
    <header>
 <div class="container-fluid header d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4">
        <div class="col-md-1">
        <img src="{{ asset('frontend/images/logo (1).png') }}" width="180px">
            </div>
        <div class="col-md-8">
      <ul class="nav col-12 col-md-auto mb-2">
        <li><a href="#" class="nav-link px-2 link-dark">Home</a></li>
        <li><a href="#" class="nav-link px-2 link-dark">About</a></li>
        <li><a href="#" class="nav-link px-2 link-dark">Servies</a></li>
        <li><a href="#" class="nav-link px-2 link-dark">Feautures </a></li>
        <li><a href="#" class="nav-link px-2 link-dark">Product Overview</a></li>
        <li><a href="#" class="nav-link px-2 link-dark">Pricing</a></li>
        <li><a href="#" class="nav-link px-2 link-dark">why facility systems?</a></li>
        <li><a href="#" class="nav-link px-2 link-dark">Contacts</a></li>
      </ul>

      </div>
      <div class="col-md-3 text-end">
        <button type="button" class="btn gradint">Get Free Demo</button>
        <button type="button" class="btn gradint">Sign Up</button>
    
      </div>
   
  </div>
</header>

  <section>
    <div class="slider-main">
        <div class="slider1">

            <div class="container slider-contant text-center">
                <h6 class="heading6">LOREM IPSUM YOUR BUSINESS</h6> 
                <h1 class="heading1">FACILITY <span style="color:#FB7D00">SERVICES FOR YOUR</span> GROWTH</h1>
                <p>Aliquam vehicula mollis urna vel dignissim. Integer tincidunt viverra est, non congue lorem tempor ac. Phasellus pulvinar iaculis nunc at placerat.</p> 
             </div>

        </div>
        <div class="slider1">
            <div class="container slider-contant text-center">
                <h6 class="heading6">LOREM IPSUM YOUR BUSINESS</h6> 
                <h1 class="heading1">FACILITY <span style="color:#FB7D00">SERVICES FOR YOUR</span> GROWTH</h1>
                <p>Aliquam vehicula mollis urna vel dignissim. Integer tincidunt viverra est, non congue lorem tempor ac. Phasellus pulvinar iaculis nunc at placerat.</p> 
             </div>
        </div>
        <div class="slider1">
            <div class="container slider-contant text-center">
                <h6 class="heading6">LOREM IPSUM YOUR BUSINESS</h6> 
                <h1 class="heading1">FACILITY <span style="color:#FB7D00">SERVICES FOR YOUR</span> GROWTH</h1>
                <p>Aliquam vehicula mollis urna vel dignissim. Integer tincidunt viverra est, non congue lorem tempor ac. Phasellus pulvinar iaculis nunc at placerat.</p> 
             </div>
        </div>
    </div>

   
        <div class="container about">
            <div class="row">

                <div class="col-6 about-img">
                    <img width="100%" src="{{ asset('frontend/images/Group 193.png') }}"/>
                </div>
                <div class="col-6 about-text  ">
                    <div class="content">
                        <h6 class="heading6">ABOUT US</h6> 
                        <h2 class="heading2">LOREM IPSUM INDUSTRY TEXT</h2>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries.</p>

                        <div class="container team-box">
                                <div class="row">
                                    <div class="col-10 item-box img-box1">
                                        <div class="row">
                                            <div class="col-2">
                                        <img src="{{ asset('frontend/images/Group 3.png') }}"/>
                                      </div>
                                     <div class="col-12 box1">
                                     <h5>Lorem Ipsum</h5>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
                                    <button type="button" class="btn gradint">Learn More</button>
                                  </div>
                                </div>                   
                            </div>                     
                         </div>  
                    </div>

                    <div class="container team-box">
                        <div class="row">
                            <div class="col-10 item-box img-box1">
                                <div class="row">
                                    <div class="col-2">
                                    <img src="{{ asset('frontend/images/Path 65.png') }}"/>
                                    </div>
                                 <div class="col-12 box1">
                                <h5>Lorem Ipsum</h5>
                              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
                             <button type="button" class="btn gradint">Learn More</button>
                          </div>
                        </div>                   
                    </div>                     
                 </div>  
            </div>

            <div class="container team-box">
                <div class="row">
                    <div class="col-10 item-box img-box1">
                        <div class="row">
                            <div class="col-2">
                              <img src="{{ asset('frontend/images/Path 23.png') }}"/>
                             </div>
                            <div class="col-12 box1">
                           <h5>Lorem Ipsum</h5>
                         <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
                       <button type="button" class="btn gradint">Learn More</button>
                  </div>
                </div>                   
            </div>                     
         </div>  
    </div>

                    <button type="button" class="btn gradint">Learn More</button>

                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid service">
                <div class="content text-center">
                    <h6 class="heading6">SERVICES</h6> 
                    <h2 class="heading2">LOREM IPSUM SERVICES</h2>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                    <div class="row">
                        <div class="col-4">
                                <figure class="effect-lily">
                                  <div class="content-overlay"></div>
                                <img src="{{ asset('frontend/images/Group 195.png') }}" alt="img12"/>
                                <figcaption>
                                    <div class="content-service">
                                        <h5>Lorem Ipsum Facility</h5>
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                        <button type="button" class="btn white">Learn More</button>
                                    </div>
                                   
                                </figcaption>			
                            </figure> 
                        </div>
                        <div class="col-4">
                            <figure class="effect-lily">
                              <div class="content-overlay"></div>
                            <img src="{{ asset('frontend/images/Group 198.png') }}" alt="img1"/>
                            <figcaption>
                              <div class="content-service">
                                    <h5>Lorem Ipsum Facility</h5>                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                    <button type="button" class="btn white">Learn More</button>
                                </div>
                              
                            </figcaption>			
                        </figure>
                    </div>
                        <div class="col-4">
                            <figure class="effect-lily">
                              <div class="content-overlay"></div>
                                <img src="{{ asset('frontend/images/Group 197.png') }}" alt="img1"/>
                                <figcaption>
                                  <div class="content-service">
                                        <h5>Lorem Ipsum Facility</h5>
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                        <button type="button" class="btn white">Learn More</button>
                                    </div>
                            </figcaption>			
                        </figure>
                    </div>
               </div>
             </div>
           </div>

           <div class="video">

            <div class="container-fluid videoscreen">
                <div class="row">
    
                    
                    <div class="col-7 video-contant about-text text-white">
                        <div class="content">
                            <h6 class="heading6">INTRO VIDEO</h6> 
                            <h2 class="heading2">HOW WE GROWTH OUR BUSINESS.</h2>
                            <p><b>Lorem Ipsum is simply dummy text of the printing and typesetting industry </b></br></br>
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,
                            </p>
                            <button type="button" class="btn gradint">Learn More</button>

                        </div>
                    </div>
                    <div class="col-5 about-img">
                        <img width="100%" src="{{ asset('frontend/images/Group 199.png') }}"/>
                    </div>
                </div>
             </div>
           </div>


           <div class="container our-team">
            <div class="content text-center">
                <h6 class="heading6">OUR TEAM</h6> 
                <h2 class="heading2">OUR EXPERIENCE TEAM</h2>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
                <div class="row">
                    <div class="col-4">
                            <figure class="effect-lily">
                              <div class="content-overlay"></div>
                            <img src="{{ asset('frontend/images/Group 202.png') }}" alt="img12"/>
                            <figcaption>
                                <div class="content-service">
                                    <h5>David Johnson</h5>
                                    <h5>Manager</h5>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                    <button type="button" class="btn white">Learn More</button>
                                </div>
                               
                            </figcaption>			
                        </figure> 
                    </div>
                    <div class="col-4">
                        <figure class="effect-lily">
                          <div class="content-overlay"></div>
                        <img src="{{ asset('frontend/images/Group 203.png') }}" alt="img1"/>
                        <figcaption>
                          <div class="content-service">
                                <h5>Roseline Diana</h5>   
                                <h5>Founder</h5>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                <button type="button" class="btn white">Learn More</button>
                            </div>
                          
                        </figcaption>			
                    </figure>
                </div>
                    <div class="col-4">
                        <figure class="effect-lily">
                          <div class="content-overlay"></div>
                            <img src="{{ asset('frontend/images/Group 204.png') }}" alt="img1"/>
                            <figcaption>
                              <div class="content-service">
                                    <h5>Jack Thomas</h5>
                                    <h5>Founder</h5>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                    <button type="button" class="btn white">Learn More</button>
                                </div>
                        </figcaption>			
                    </figure>
                </div>
           </div>
         </div>
       </div>


           <div class="container-fluid satisfaction">
            <div class="container">
            <div class="content text-center">
                <h6 class="heading6">SATISFACTION</h6> 
                <h2 class="heading2">CUSTOMERS SATISFACTION</h2>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, whe.</p>
                <div class="row">
                    <div class="col-3">
                        <div class="circle_percent" data-percent="80">
                            <div class="circle_inner">
                                <div class="round_per"></div>
                            </div>
                        </div>
                        <h5>Lorem Ipsum</h5>
                        <p>Lorem Ipsum is simply dummy text of the printing.</p>
                                       
                    </div>
                    <div class="col-3"><div class="circle_percent" data-percent="78">
                        <div class="circle_inner">
                            <div class="round_per"></div>
                        </div>
                    </div>
                    <h5>Lorem Ipsum</h5>
                    <p>Lorem Ipsum is simply dummy text of the printing.</p>
                </div>
                    
                    <div class="col-3"><div class="circle_percent" data-percent="65">
                        <div class="circle_inner">
                            <div class="round_per"></div>
                        </div>
                    </div>
                    <h5>Lorem Ipsum</h5>
                    <p>Lorem Ipsum is simply dummy text of the printing.</p>
                </div>
                    <div class="col-3"><div class="circle_percent" data-percent="100">
                        <div class="circle_inner">
                            <div class="round_per"></div>
                        </div>
                    </div>
                    <h5>Lorem Ipsum</h5>
                    <p>Lorem Ipsum is simply dummy text of the printing.</p>
                         </div>
                      </div>
                    </div>
                 </div>  
                </div>  

                 <div class="container">
                    <div class="portfolio text-center">
                        <h3 class="heading3">PORTFOLIO</h3>
                        <div class="row">
                            <div class="col-3 galley1">
                                <img src="{{ asset('frontend/images/Group 97.png') }}"/>
                                <img src="{{ asset('frontend/images/Group 101.png') }}"/>

                            </div>
                            <div class="col-3 galley2">
                                <img src="{{ asset('frontend/images/Group 98.png') }}"/>
                                <img src="{{ asset('frontend/images/Group 102.png') }}"/>


                            </div>
                            <div class="col-3 galley1">
                                <img src="{{ asset('frontend/images/Group 99.png') }}"/>
                                <img src="{{ asset('frontend/images/Group 103.png') }}"/>
                              </div>
                             <div class="col-3 galley2">
                                <img src="{{ asset('frontend/images/Group 100.png') }}"/>
                                <img src="{{ asset('frontend/images/Group 104.png') }}"/>
                            </div>
                        </div>
                    </div>
                 </div>

                 <div class="container">
                    <div class="testimonials text-center">
                        <h6 class="heading6">TESTIMONIALS</h6> 
                        <h2 class="heading2">WHAT OUR CLIENTS SAY</h2>

                        <main>
                              <div class="testimonial">
                                <div class="container">
                                 <div class="testimonial__inner">
                                   <div class="testimonial-slider">
                                     <div class="testimonial-slide">
                                       <div class="testimonial_box">
                                         <div class="testimonial_box-inner">
                                           <div class="testimonial_box-top">
                                             <div class="testimonial_box-icon">
                                               <i class="fas fa-quote-right"></i>
                                             </div>
                                             <div class="testimonial_box-text">
                                              <img src="{{ asset('frontend/images/Shape.png') }}"/>
                                              <span class="star">&#9733;&#9733;&#9733;&#9733;&#9733;</span>
                                               <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus scelerisque aliquam nulla. Mauris mauris nulla, pulvinar et nisi sit amet, interdum luctus lacus. Vivamus volutpat orci risus, quis feugiat elit tincidunt in. Quisque gravida ante non elit cursus pharetra.</p>
                                             </div>
                                             <div class="testimonial_box-img">
                                              <img src="{{ asset('frontend/images/Oval.png') }}" alt="profile">
                                            </div>
                                            <div class="testimonial_box-name">
                                              <h4>Gunther Ackner</h4>
                                           </div>
                                           <div class="testimonial_box-job">
                                             <p>Office Manager</p>
                                           </div>
                                           </div>
                                         </div>
                                       </div>
                                     </div>
                                     <div class="testimonial-slide">
                                      <div class="testimonial_box">
                                        <div class="testimonial_box-inner">
                                          <div class="testimonial_box-top">
                                            <div class="testimonial_box-icon">
                                              <i class="fas fa-quote-right"></i>
                                            </div>
                                            <div class="testimonial_box-text">
                                              
                                              <img src="{{ asset('frontend/images/Shape.png') }}"/>
                                              <span class="star">&#9733;&#9733;&#9733;&#9733;&#9733;</span>
                                              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus scelerisque aliquam nulla. Mauris mauris nulla, pulvinar et nisi sit amet, interdum luctus lacus. Vivamus volutpat orci risus, quis feugiat elit tincidunt in. Quisque gravida ante non elit cursus pharetra.</p>
                                            </div>
                                            <div class="testimonial_box-img">
                                             <img src="{{ asset('frontend/images/Oval.png') }}" alt="profile">
                                           </div>
                                           <div class="testimonial_box-name">
                                             <h4>Gunther Ackner</h4>
                                          </div>
                                          <div class="testimonial_box-job">
                                            <p>Office Manager</p>
                                          </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="testimonial-slide">
                                      <div class="testimonial_box">
                                        <div class="testimonial_box-inner">
                                          <div class="testimonial_box-top">
                                            <div class="testimonial_box-icon">
                                              <i class="fas fa-quote-right"></i>
                                            </div>
                                            <div class="testimonial_box-text">
                                              <img src="{{ asset('frontend/images/Shape.png') }}"/>
                                              <span class="star">&#9733;&#9733;&#9733;&#9733;&#9733;</span>
                                              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus scelerisque aliquam nulla. Mauris mauris nulla, pulvinar et nisi sit amet, interdum luctus lacus. Vivamus volutpat orci risus, quis feugiat elit tincidunt in. Quisque gravida ante non elit cursus pharetra.</p>
                                            </div>
                                            <div class="testimonial_box-img">
                                             <img src="{{ asset('frontend/images/Oval.png') }}" alt="profile">
                                           </div>
                                           <div class="testimonial_box-name">
                                             <h4>Gunther Ackner</h4>
                                          </div>
                                          <div class="testimonial_box-job">
                                            <p>Office Manager</p>
                                          </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                   </div>
                                 </div>
                                </div>
                           </div>
                        </main>
                    </div>
                </div>

                
                  <div class="blogs text-center">
                    <div class="container">
                      <h2 class="heading2">BLOG</h2>
                      <div class="container text-start">
                      <div class="row">
                        <div class="col-4 blog-box">
                          <img src="{{ asset('frontend/images/house1.png') }} " width="100%"/>
                          <div class="blog-contant">
                          <h4>Lorem Ipsum Religious Facility</h4>
                          <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</p>
                          <ul class="meta-box">
                            <li><span class="blog-icon"><img src="image/admin-icon.png">Admin</span></li>
                         <li><span class="blog-icon"><img src="image/message-icon3.png">Comment</span></li>
                        </ul>
                        </div>
                       </div>
                       <div class="col-4 blog-box">
                        <img src="{{ asset('frontend/images/blog.png') }} " width="100%"/>
                        <div class="blog-contant">
                        <h4>Lorem Ipsum Religious Facility</h4>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</p>
                        <ul class="meta-box">
                          <li><span class="blog-icon"><img src="{{ asset('frontend/images/admin-icon.png') }} ">Admin</span></li>
                       <li><span class="blog-icon"><img src="{{ asset('frontend/images/message-icon3.png') }} ">Comment</span></li>
                      </ul>
                      </div>
                     </div><div class="col-4 blog-box">
                      <img src="{{ asset('frontend/images/house2.png') }} " width="100%"/>
                      <div class="blog-contant">
                      <h4>Lorem Ipsum Religious Facility</h4>
                      <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</p>
                      <ul class="meta-box">
                      <li><span class="blog-icon"><img src="{{ asset('frontend/images/admin-icon.png') }} ">Admin</span></li>
                      <li><span class="blog-icon"><img src="{{ asset('frontend/images/message-icon3.png') }} ">Comment</span></li>
                     </ul>
                    </div>
                   </div>
                 </div>
                </div>
              </div>
               </div>
  </section>
  <footer>
    <div class="container">
        <div class="row foot text-white">
          <div class="col-4">
            <img src="{{ asset('frontend/images/logo (1).png') }} " height="50px" width="180px">
            <p class="foot-txt about-me">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been standard dummy text of the printing.</p>
          <ul class="contact-icon">
            <li><a href="#"><img src="{{ asset('frontend/images/map-icon.png') }} ">01 0000 0000 000</a></li>
            <li><a href="#"><img src="{{ asset('frontend/images/phone-icon.png') }} ">Helloworld@example.com</a></li>
            <li><a href="#"><img src="{{ asset('frontend/images/mail-icon.png') }} ">606 Briskin Lane Chicago, TN 37087</a></li>
          </ul>
          </div>
          <div class="col-2">
            <h4>Explore</h4> 
            <ul class="foot-txt">
              <li>About Us</li>
              <li>Meet our team</li>
              <li>Case Stories</li>
              <li>Lastest News</li>
              <li>Contact</li>

            </ul>
          </div>
          <div class="col-2">
            <h5 style="color: black;">..</h5>
            <ul class="foot-txt">
              <li>Support</li>
              <li>Terms of use</li>
              <li>Privacy & Policy</li>
              <li>Help</li>
            </ul>
          </div>
          
          <div class="col-4">
            <h4>Newsletter</h4>
            <form action="/action_page.php">
              <div class="form-group">
                <p style="color: black;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla ut libero ut diam finibus</p>
                <label for="email"></label>
                 <input type="email" placeholder="Email Address" class="form-control" id="email"  name="email">
                <button type="submit" class="btn gradint">Register</button>

              </div>
            </form>
          </div>
    
          <div class="copy-right ">
          <p>2023 Copy Right All Right Reserved -</p>
          <ul class="socialization">
            <li><a href="#"><img src="{{ asset('frontend/images/fb.png') }} "></a></li>
            <li><a href="#"><img src="{{ asset('frontend/images/twiter.png') }} "></a></li>
            <li><a href="#"><img src="{{ asset('frontend/images/insta.png') }} "></a></li>
          </ul>
        </div>
        
          </div>
      </div>
    </div>
    </footer>

  <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
  <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
  <script>
    $('.slider-main').slick();
</script>

<script>
    $(".circle_percent").each(function() {
    var $this = $(this),
		$dataV = $this.data("percent"),
		$dataDeg = $dataV * 3.6,
		$round = $this.find(".round_per");
	$round.css("transform", "rotate(" + parseInt($dataDeg + 180) + "deg)");	
	$this.append('<div class="circle_inbox"><span class="percent_text"></span></div>');
	$this.prop('Counter', 0).animate({Counter: $dataV},
	{
		duration: 2000, 
		easing: 'swing', 
		step: function (now) {
            $this.find(".percent_text").text(Math.ceil(now)+"%");
        }
    });
	if($dataV >= 51){
		$round.css("transform", "rotate(" + 360 + "deg)");
		setTimeout(function(){
			$this.addClass("percent_more");
		},1000);
		setTimeout(function(){
			$round.css("transform", "rotate(" + parseInt($dataDeg + 180) + "deg)");
		},1000);
	} 
});
</script>
<script>
    $(document).ready(function() {
    $('.testimonial-slider').slick({
        autoplay: true,
        autoplaySpeed: 1000,
        speed: 600,
        draggable: true,
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: true,
        dots: false,
        responsive: [
            {
              breakpoint: 991,
              settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
              }
            },
            {
                breakpoint: 575,
                settings: {
                  slidesToShow: 1,
                  slidesToScroll: 1,
                }
            }
        ]
    });
}); 
</script>
</body>
</html>
