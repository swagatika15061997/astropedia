@extends('layouts.frontend.app')
@section('title','Service Details')
@push('css_or_js')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .astro_l a.active {
    /* background-color: red; */
    background-image: -webkit-linear-gradient(0deg, rgb(253, 200, 48) 0%, rgb(243, 115, 53) 100%);
}
    </style>
@endpush
@section('content')
<section class="as_breadcrum_wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h1>{{$service->name}}</h1> 

                        <ul class="breadcrumb"> 
                            <li><a href="/">Home</a></li>
                            <li>{{$service->name}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <?php
          $services = \App\Models\Service::where('status',1)->orderBy('id','DESC')->get();
          $skills = \App\Models\Skill::where('status',1)->orderBy('id','DESC')->get();
          $astrologers = \App\Models\Astrologer::where('status','approved')->orderBy('id','DESC')->get();
          
        ?>
        <section class="as_blog_wrapper as_padderBottom90 as_padderTop80">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
                        <div class="as_shop_sidebar">
                            <div class="as_widget as_search_widget">
                                <input type="text" name="" class="form-control" id="" placeholder="Search"/>
                                <span><img src="{{asset('frontend/assets/images/svg/search.svg')}}" alt=""></span>
                            </div>
                            <div class="as_widget as_category_widget">
                                <h3 class="as_widget_title">Service List</h3>

                                <ul>
                                    @foreach($lists as $list)
                                    <li><a href="javascript:;">{{$list->name}}</a></li>
                                    @endforeach
                                    
                                </ul>
                            </div>
                            <!-- <div class="as_widget as_category_widget">
                                <h3 class="as_widget_title">Archives</h3>

                                <ul>
                                    <li><a href="javascript:;">January 2022 (20)</a></li>
                                    <li><a href="javascript:;">February 2022 (15)</a></li>
                                    <li><a href="javascript:;">March 2022 (5)</a></li>
                                    <li><a href="javascript:;">April 2022 (3)</a></li>
                                    <li><a href="javascript:;">May 2022 (18)</a></li>
                                    <li><a href="javascript:;">June 2022 (7)</a></li>
                                </ul>
                            </div> -->
                            <!-- <div class="as_widget as_workinghours_widget">
                                <h3 class="as_widget_title">Working Hours</h3>

                                <ul>
                                    @foreach($astrologers as $astrologer)
                                    @if($astrologer->serviceCategory == $service->id)
                                    <?php
                                      $astrologer_availability = \App\Models\AstrologerAvailability::where('astrologerId',$astrologer->id)->orderBy('id','ASC')->get();
                                    ?>
                                    @foreach($astrologer_availability as $avail)
                                    <li>
                                       <a href="javascript:;">
                                          <span>{{$avail->day}}</span> 
                                          @if($avail->fromTime )
                                            <span>{{$avail->fromTime}} - {{$avail->toTime}}</span>
                                          @endif
                                       </a>
                                    </li>
                                    @endforeach
                                    @endif
                                    @endforeach
                                    
                                </ul>
                                
                            </div> -->

                            <!-- <div class="as_widget as_product_widget as_post_widget">
                                <h3 class="as_widget_title">Recent Posts</h3>

                                <ul>
                                    <li class="as_product">
                                        <a href="shop_single.html">
                                            <span class="as_productimg">
                                                <img src="assets/images/post1.jpg" alt="">
                                            </span>
                                            <span class="as_product_detail">
                                                <span><img src="assets/images/svg/calendar.svg" alt=""> 14/01/2022</span>
                                                <span>Lorem ipsum dolor sit amet, consectetur.</span>
                                            </span>
                                        </a>
                                    </li>
                                    <li class="as_product">
                                        <a href="shop_single.html">
                                            <span class="as_productimg">
                                                <img src="assets/images/post1.jpg" alt="">
                                            </span>
                                            <span class="as_product_detail">
                                                <span><img src="assets/images/svg/calendar.svg" alt=""> 14/01/2022</span>
                                                <span>Lorem ipsum dolor sit amet, consectetur.</span>
                                            </span>
                                        </a>
                                    </li>
                                    <li class="as_product">
                                        <a href="shop_single.html">
                                            <span class="as_productimg">
                                                <img src="assets/images/post1.jpg" alt="">
                                            </span>
                                            <span class="as_product_detail">
                                                <span><img src="assets/images/svg/calendar.svg" alt=""> 14/01/2022</span>
                                                <span>Lorem ipsum dolor sit amet, consectetur.</span>
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </div> -->

                            <div class="as_widget as_faq_widget">
                                <h3 class="as_widget_title">FAQ</h3>

                                <div class="accordion as_accordion" id="accordionPanelsStayOpenExample">
                                    <div class="accordion-item">
                                      <div class="accordion-header" id="panelsStayOpen-headingOne">
                                        <h2 class="mb-0">
                                          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                            What is 'the zodiac'
                                          </button>
                                        </h2>
                                      </div>
                                  
                                      <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                                        <div class="accordion-body">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                                        </div>
                                      </div>
                                    </div>
                                    <div class="accordion-item">
                                      <div class="accordion-header" id="panelsStayOpen-headingTwo">
                                        <h2 class="mb-0">
                                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                                            What is a Rising Sign?
                                          </button>
                                        </h2>
                                      </div>
                                      <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
                                        <div class="accordion-body">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                                        </div>
                                      </div>
                                    </div>
                                    <div class="accordion-item">
                                      <div class="accordion-header" id="panelsStayOpen-headingThree">
                                        <h2 class="mb-0">
                                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                                            What is 'the house' ?
                                          </button>
                                        </h2>
                                      </div>
                                      <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingThree">
                                        <div class="accordion-body">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                                        </div>
                                      </div>
                                    </div>
                                    <div class="accordion-item">
                                      <div class="accordion-header" id="panelsStayOpen-headingFour">
                                        <h2 class="mb-0">
                                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFour" aria-expanded="false" aria-controls="panelsStayOpen-collapseFour">
                                            What is a Ascendant?
                                          </button>
                                        </h2>
                                      </div>
                                      <div id="panelsStayOpen-collapseFour" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingFour">
                                        <div class="accordion-body">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                            </div>

                            <div class="as_widget as_share_widget as_share_box">
                                <h3 class="as_widget_title">Social Share</h3>

                                <ul>
                                    <li><a href="javascript:;">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="10px" height="19px"> <path fill-rule="evenodd" d="M6.491,19.000 L6.491,10.333 L9.439,10.333 L9.881,6.956 L6.491,6.956 L6.491,4.799 C6.491,3.821 6.765,3.155 8.188,3.155 L10.000,3.154 L10.000,0.132 C9.687,0.092 8.611,-0.000 7.359,-0.000 C4.746,-0.000 2.956,1.574 2.956,4.464 L2.956,6.956 L-0.000,6.956 L-0.000,10.333 L2.956,10.333 L2.956,19.000 L6.491,19.000 Z"/> </svg>
                                    </a></li>
                                    <li><a href="javascript:;">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20px" height="16px"> <path fill-rule="evenodd" d="M20.000,1.892 C19.257,2.213 18.464,2.426 17.637,2.530 C18.487,2.030 19.137,1.244 19.442,0.298 C18.649,0.764 17.774,1.092 16.842,1.276 C16.089,0.487 15.017,-0.002 13.847,-0.002 C11.576,-0.002 9.748,1.812 9.748,4.037 C9.748,4.357 9.776,4.664 9.843,4.957 C6.435,4.794 3.418,3.184 1.392,0.734 C1.038,1.338 0.831,2.030 0.831,2.775 C0.831,4.173 1.562,5.413 2.652,6.130 C1.993,6.118 1.347,5.930 0.800,5.633 C0.800,5.645 0.800,5.661 0.800,5.677 C0.800,7.639 2.221,9.269 4.085,9.644 C3.751,9.734 3.387,9.777 3.010,9.777 C2.747,9.777 2.482,9.763 2.233,9.708 C2.765,11.307 4.272,12.483 6.065,12.521 C4.670,13.595 2.898,14.243 0.981,14.243 C0.645,14.243 0.322,14.228 -0.000,14.187 C1.816,15.341 3.968,15.999 6.290,15.999 C13.835,15.999 17.960,9.845 17.960,4.510 C17.960,4.332 17.954,4.160 17.945,3.989 C18.759,3.420 19.442,2.709 20.000,1.892 Z"/> </svg>
                                    </a></li>
                                    <li><a href="javascript:;">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="17px" height="17px"> <path fill-rule="evenodd" d="M16.995,16.998 L16.995,16.999 L13.477,16.999 L13.477,11.474 C13.477,10.157 13.450,8.469 11.645,8.469 C9.813,8.469 9.532,9.899 9.532,11.379 L9.532,16.998 L6.013,16.998 L6.013,5.650 L9.393,5.650 L9.393,7.197 L9.442,7.197 C9.912,6.306 11.062,5.365 12.777,5.365 C16.342,5.365 16.998,7.714 16.998,10.764 L16.998,16.998 L16.995,16.998 ZM2.041,4.102 C0.914,4.102 -0.000,3.169 -0.000,2.042 C-0.000,0.915 0.914,0.001 2.041,0.001 C3.167,0.001 4.082,0.915 4.082,2.042 C4.082,3.169 3.168,4.102 2.041,4.102 ZM3.804,16.999 L0.280,16.999 L0.280,5.650 L3.804,5.650 L3.804,16.999 Z"/> </svg>
                                    </a></li>
                                    <li><a href="javascript:;">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="21px" height="14px"> <path fill-rule="evenodd" d="M20.107,1.349 C19.538,0.366 18.920,0.186 17.661,0.117 C16.404,0.034 13.242,-0.000 10.503,-0.000 C7.758,-0.000 4.595,0.034 3.339,0.116 C2.083,0.186 1.463,0.365 0.889,1.349 C0.302,2.330 -0.000,4.020 -0.000,6.996 C-0.000,6.999 -0.000,7.000 -0.000,7.000 C-0.000,7.003 -0.000,7.004 -0.000,7.004 L-0.000,7.006 C-0.000,9.969 0.302,11.672 0.889,12.643 C1.463,13.626 2.082,13.804 3.338,13.887 C4.595,13.958 7.758,14.000 10.503,14.000 C13.242,14.000 16.404,13.958 17.662,13.888 C18.921,13.805 19.539,13.627 20.109,12.645 C20.701,11.673 21.000,9.970 21.000,7.007 C21.000,7.007 21.000,7.004 21.000,7.001 C21.000,7.001 21.000,6.999 21.000,6.997 C21.000,4.020 20.701,2.330 20.107,1.349 ZM7.875,10.818 L7.875,3.182 L14.437,7.000 L7.875,10.818 Z"/> <path fill="url(#PSgrad_0)" d="M20.107,1.349 C19.538,0.366 18.920,0.186 17.661,0.117 C16.404,0.034 13.242,-0.000 10.503,-0.000 C7.758,-0.000 4.595,0.034 3.339,0.116 C2.083,0.186 1.463,0.365 0.889,1.349 C0.302,2.330 -0.000,4.020 -0.000,6.996 C-0.000,6.999 -0.000,7.000 -0.000,7.000 C-0.000,7.003 -0.000,7.004 -0.000,7.004 L-0.000,7.006 C-0.000,9.969 0.302,11.672 0.889,12.643 C1.463,13.626 2.082,13.804 3.338,13.887 C4.595,13.958 7.758,14.000 10.503,14.000 C13.242,14.000 16.404,13.958 17.662,13.888 C18.921,13.805 19.539,13.627 20.109,12.645 C20.701,11.673 21.000,9.970 21.000,7.007 C21.000,7.007 21.000,7.004 21.000,7.001 C21.000,7.001 21.000,6.999 21.000,6.997 C21.000,4.020 20.701,2.330 20.107,1.349 ZM7.875,10.818 L7.875,3.182 L14.437,7.000 L7.875,10.818 Z"/> </svg>
                                    </a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12">
                        <div class="as_service_single">
                            <div class="as_service_img">
                                <img src="{{asset('images/service/'.$service->banner_image)}}" alt="" class="img-responsive">
                            </div>
                            <h3>{{$service->title}}</h3>
                            <p class="as_margin0 as_padderBottom20">{{$service->description}}</p>
                            <div class="as_bookingform">  
                                <div class="as_booking_section as_padderBottom10">
                                    <h3 class="as_bookingheading"><img src="{{asset('frontend/assets/images/svg/user2.svg')}}" alt=""> Astrologer</h3>
                                    <div class="container mt-5">
                                      <ul class="nav nav-tabs">
                                          @foreach($astrologers as $astrologer)
                                              @if($astrologer->serviceCategory == $service->id)
                                                  <li class="nav-item astro_l">
                                                      <a class="nav-link" data-bs-toggle="tab" href="#astrologer{{$astrologer->id}}" role="tab">
                                                          <img src="{{asset('images/profile/'.$astrologer->image)}}" alt="" class="img-responsive" style="width:100px;height:100px;border-radius: 10px;">
                                                          <h5 style="font-size: 18px;color: var(--dark-color1);font-weight: 600;padding-top: 6px;">{{$astrologer->name}}</h5>
                                                      </a>
                                                  </li>
                                              @endif
                                          @endforeach
                                      </ul>
                                      <div class="tab-content mt-2">
                                          @foreach($astrologers as $astrologer)
                                              @if($astrologer->serviceCategory == $service->id)
                                                  <div id="astrologer{{$astrologer->id}}" class="tab-pane fade">
                                                  <?php
                                                                        $astrologer_availability = \App\Models\AstrologerAvailability::where('astrologerId',$astrologer->id)->orderBy('id','ASC')->get();
                                                                      ?>
                                                                      @foreach($astrologer_availability as $avail)
                                                                      <li>
                                                                         <a href="javascript:;">
                                                                            <span>{{$avail->day}}</span> 
                                                                            @if($avail->fromTime )
                                                                              <span>{{$avail->fromTime}} - {{$avail->toTime}}</span>
                                                                            @endif
                                                                         </a>
                                                                      </li>
                                                                      @endforeach
                                                  </div>
                                              @endif
                                          @endforeach
                                          @if(auth()->check())
                                          <a href="javascript:;" class="as_btn" id="bookNowBtn">Book Now</a>
                                          @else
                                              <p>Please <a href="{{ route('login') }}">login</a> to book the service.</p>
                                          @endif
                                      </div>
                                   </div>
    
                                </div>
                                
                            </div>
    
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>     
        <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    var servicePrice = "{{ $service->price }}"; // Replace this with the actual price

    document.getElementById('bookNowBtn').onclick = function() {
        var options = {
            "key": "rzp_test_pjOjfWjDOzYK31", // Replace with your Razorpay API key
            "amount": servicePrice * 100, // Amount in paise
            "currency": "INR", // Change as needed
            "name": "Your Company Name",
            "description": "Service Payment",
            "handler": function(response) {
                console.log(response.razorpay_payment_id);
                // Handle the successful payment here
                var paymentId = response.razorpay_payment_id;
                var serviceId = "{{ $service->id }}"; 
                var astrologerId = document.getElementById('astrologer_id').innerText.trim();
                var amount = servicePrice;
                var userId = "{{ auth()->id() }}";
                // Send payment details to server for storing booking data
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '/payment/success');
                xhr.setRequestHeader('Content-Type', 'application/json');
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        // Redirect or show success message
                        window.location.href = '/bookingSuccess';
                    } else {
                        // Handle error
                        console.error('Error:', xhr.statusText);
                    }
                };
                xhr.onerror = function() {
                    // Handle network errors
                    console.error('Network Error');
                };
                // Include CSRF token in the request
                var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                xhr.setRequestHeader('X-CSRF-TOKEN', token);

                xhr.send(JSON.stringify({
                    payment_id: paymentId,
                    service_id: serviceId,
                    astrologer_id: astrologerId,
                    amount: amount,
                    user_id: userId
                }));

            },
            "prefill": {
                "name": "Customer Name",
                "email": "customer@example.com"
            },
            "theme": {
                "color": "#F37254"
            }
        };
        var rzp = new Razorpay(options);
        rzp.open();
    }
</script>
@endsection