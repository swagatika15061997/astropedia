<section class="as_footer_wrapper as_padderTop80">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="as_know_sign_wrapper as_padderBottom50 as_padderTop100">
                            <div class="row">
                                <div class="col-lg-4">
                                    <h1 class="as_heading as_heading_center">Zodiac Sign Finder</h1>
                                </div>   
                                <div class="col-lg-8">
                                    <div class="as_sign_form text-left">
                                    <form action="{{ route('zodiac-sign') }}" method="GET">
                                        @csrf
    <ul>
       <li class="as_form_box">
            <div class="as_input_feild as_select_box">
                <b>Date Of Birth:</b>
            </div>
        </li>
        <li class="as_form_box">
            <div class="as_input_feild as_select_box">
                <input class="form-control" type="date" name="birthdate" data-placeholder="Birthdate">
            </div>
        </li>
        <li class="as_form_box">
            <button class="as_btn">Submit</button>
        </li>
    </ul>
</form>

                                    </div>
                                </div>
                            </div>
                        </div>
                        

                        <div class="as_footer_inner as_padderTop10 as_padderBottom40">
                            <div class="row">
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="as_footer_widget">
                                        <div class="as_footer_logo">
                                            <a href="index.html"><img src="{{asset('frontend/assets/images/logo1.png')}}" alt=""></a>
                                        </div>
                                        <p>There are many variations of this passages of Lorem Ipsum.</p>

                                        <ul class="as_contact_list">
                                            <li>
                                                <img src="{{asset('frontend/assets/images/svg/map.svg')}}" alt="">
                                                <p>488, 3rd Floor, Bomikhal
                                                    Laxmisagar, Bhubaneswar,751010</p>
                                            </li>
                                            <li>
                                                <img src="{{asset('frontend/assets/images/svg/phone.svg')}}" alt="">
                                                <p>
                                                    <a href="javascript:;">+91 7019626663</a>
                                                </p>
                                            </li>
                                            <li>
                                                <img src="{{asset('frontend/assets/images/svg/mail.svg')}}" alt="">
                                                <p>
                                                    <a href="javascript:;">support@aicopl.com</a>
                                                </p> 
                                            </li> 
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="as_footer_widget">
                                    <h3 class="as_footer_heading">Quick Links</h3>

                                    <ul>
                                        <li><a href="about.html"> About Us</a></li>
                                        <li><a href="blog.html"> Blog</a></li>
                                        <li><a href="appointment.html"> Appointment</a></li>
                                        <li><a href="contact.html"> Contact Us</a></li>
                                    </ul>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="as_footer_widget">
                                    <h3 class="as_footer_heading">Horoscope Forecasts</h3>
                                    <ul>
                                        <li><a href="{{route('horoscope.today')}}">Today's Horoscope</a></li>
                                        <li><a href="{{route('horoscope.yesterday')}}">Yesterday's Horoscope</a></li>
                                        <li><a href="{{route('horoscope.tomorrow')}}">Tomorrow's Horoscope</a></li>
                                        <li><a href="{{route('horoscope.weekly')}}">Weekly Horoscope</a></li>
                                        <li><a href="{{route('horoscope.monthly')}}">Monthly Horoscope</a></li>
                                        <li><a href="{{route('horoscope.yearly')}}">Yearly Horoscope</a></li>
                                    </ul>
                                    </div>
                                </div>
                                
                                
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="as_footer_widget">
                                    <h3 class="as_footer_heading">Our Newsletter</h3>

                                    <p>Lorem ipsum dolor amet, consectetur adipiscing elit,sed eiusmod tempor. </p>

                                    <div class="as_newsletter_wrapper">
                                            <div class="as_newsletter_box">
                                                <input type="text" name="" id="" class="form-control" placeholder="Email...">
                                                <a href="javascript:;" class="as_btn">
                                                    <img src="{{asset('frontend/assets/images/svg/plane.svg')}}" alt="">
                                                </a>
                                            </div>
                                        </div>

                                        <div class="as_login_data">
                                            <label>I agree that my submitted data is
                                                being collected and stored.
                                                <input type="checkbox" name="as_remember_me" value="">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="as_copyright_wrapper text-center">
                            <p>Copyright &copy; 2024 Astropedia. All Right Reserved.</p>
                        </div> 
                    </div>
                </div>
            </div>
        </section>