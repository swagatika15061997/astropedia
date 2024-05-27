@extends('layouts.frontend.app')
@section('title','Services')
@push('css_or_js')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush
@section('content')
<section class="as_breadcrum_wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h1>Services</h1> 

                        <ul class="breadcrumb"> 
                            <li><a href="/">Home</a></li>
                            <li>Our Services</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
       
        <section class="as_service_wrapper as_padderTop80 as_padderBottom80">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h1 class="as_heading as_heading_center">our services</h1>
                        <span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="240" height="15" viewBox="0 0 240 15">
                            <image id="Vector_Smart_Object" data-name="Vector Smart Object" width="240" height="15" xlink:href="data:img/png;base64,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"/>
                          </svg>
                          </span>
                        <p class="as_font14 as_padderTop20 as_padderBottom20">Consectetur adipiscing elit, sed do eiusmod tempor incididuesdeentiut labore <br>etesde dolore magna aliquapspendisse and the gravida.</p>
                    </div>
                </div>

                  
                <div class="row as_verticle_center">
                   <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="as_service_img">
                            <img src="{{asset('frontend/assets/images/service_img2.png')}}" alt="" class="as_service_circle img-responsive">
                            <img src="{{asset('frontend/assets/images/service_img1.jpg')}}" alt="" class="as_service_img img-responsive">
                        </div>
                   </div>
                   <div class="col-lg-6 col-md-12 col-sm-12">
                      <?php
                        $services = \App\Models\Service::where('status',1)->get(); // Replace 'Service' with your actual model name and $serviceId with the ID of the service you want to retrieve
                      ?>
                        <div class="row">
                          @foreach($services as $service)
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="as_service_box text-center">
                                    <span class="as_icon">
                                      <img src="{{asset('images/service/'.$service->image)}}" onerror="this.src='{{asset('backend/assets/images/demo/def.jpg')}}'" alt="image">
                                    </span>
                                    <h4 class="as_subheading">{{$service->name}}</h4>
                                    <p class="as_paddingBottom10">{{$service->title}}</p>
                                    <a href="{{route('service-details',$service->id)}}" class="as_link">read more 
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="7" viewBox="0 0 12 7"> <path class="cls-1" d="M8.966,4.52H1.312A1.644,1.644,0,0,1,.976,4.5,0.656,0.656,0,0,1,.447,3.8a0.672,0.672,0,0,1,.7-0.575q2.824,0,5.649,0c0.7,0,1.4,0,2.13-.051C8.546,2.814,8.166,2.455,7.782,2.1A0.675,0.675,0,0,1,7.523,1.5,0.629,0.629,0,0,1,7.981.959a0.688,0.688,0,0,1,.726.187L10.429,2.8l0.58,0.557a0.637,0.637,0,0,1,.011,1.016q-1.149,1.109-2.3,2.212a0.7,0.7,0,0,1-1.006.036A0.635,0.635,0,0,1,7.77,5.658C8.151,5.294,8.533,4.932,8.966,4.52Z"/> </svg>
                                        </span>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="as_service_box text-center">
                                    <span class="as_icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="71" height="71" viewBox="0 0 71 71"> <path d="M60.602,60.602 C53.897,67.307 44.982,71.000 35.500,71.000 C28.999,71.000 22.640,69.226 17.111,65.871 C16.265,65.358 15.429,64.802 14.626,64.218 C14.153,63.873 14.049,63.209 14.393,62.736 C14.738,62.262 15.402,62.158 15.875,62.503 C16.630,63.052 17.416,63.575 18.211,64.058 C23.409,67.211 29.387,68.878 35.500,68.878 C44.416,68.878 52.798,65.406 59.102,59.102 C65.407,52.798 68.878,44.416 68.878,35.500 C68.878,26.584 65.407,18.202 59.102,11.898 C52.798,5.593 44.416,2.121 35.500,2.121 C26.584,2.121 18.202,5.593 11.898,11.898 C5.593,18.202 2.121,26.584 2.121,35.500 C2.121,44.187 5.441,52.414 11.469,58.665 C11.876,59.087 11.864,59.759 11.442,60.165 C11.020,60.572 10.349,60.560 9.942,60.138 C3.531,53.489 -0.000,44.739 -0.000,35.500 C-0.000,26.017 3.693,17.103 10.398,10.398 C17.103,3.693 26.018,-0.000 35.500,-0.000 C44.982,-0.000 53.897,3.693 60.602,10.398 C67.307,17.103 71.000,26.017 71.000,35.500 C71.000,44.982 67.307,53.897 60.602,60.602 ZM27.588,8.676 C27.440,8.109 27.780,7.530 28.347,7.382 C32.783,6.227 37.443,6.129 41.922,7.090 C55.258,9.953 65.084,22.126 65.084,35.761 C65.084,51.930 51.930,65.084 35.760,65.084 C32.479,65.084 29.202,64.534 26.104,63.450 C20.792,61.592 16.067,58.180 12.613,53.740 C11.753,52.635 11.028,51.463 10.291,50.277 C9.858,49.580 9.529,49.050 9.243,48.273 C8.954,47.485 8.554,46.733 8.260,45.943 C7.053,42.691 6.437,39.229 6.437,35.761 C6.437,30.049 8.124,24.405 11.254,19.652 C14.116,15.305 18.131,11.754 22.798,9.450 C23.324,9.191 23.960,9.407 24.219,9.932 C24.478,10.457 24.263,11.094 23.738,11.353 C19.362,13.512 15.651,16.809 12.979,20.897 L25.467,20.897 L32.871,8.713 C31.523,8.856 30.188,9.095 28.882,9.435 C28.314,9.583 27.736,9.243 27.588,8.676 ZM38.344,8.681 L45.767,20.897 L58.532,20.897 C54.114,14.153 46.785,9.481 38.344,8.681 ZM59.662,23.139 C59.631,23.084 59.570,23.019 59.456,23.019 L47.056,23.019 L53.462,33.560 L59.658,23.378 C59.717,23.280 59.693,23.194 59.662,23.139 ZM62.963,35.761 C62.963,32.094 62.232,28.595 60.911,25.400 L54.703,35.602 L60.985,45.939 C62.259,42.793 62.963,39.358 62.963,35.761 ZM59.779,48.271 C59.809,48.216 59.834,48.130 59.774,48.033 L53.461,37.643 L46.920,48.391 L59.573,48.391 C59.687,48.391 59.748,48.326 59.779,48.271 ZM35.617,62.667 C35.678,62.667 35.762,62.647 35.819,62.553 L41.687,52.910 C41.991,52.410 42.644,52.251 43.144,52.556 C43.645,52.860 43.804,53.513 43.499,54.013 L38.116,62.859 C46.699,62.120 54.156,57.378 58.605,50.513 L28.089,50.513 L35.416,62.553 C35.473,62.647 35.557,62.667 35.617,62.667 ZM33.102,62.832 L25.605,50.513 L12.917,50.513 C17.313,57.297 24.646,62.008 33.102,62.832 ZM11.675,48.391 L24.314,48.391 L17.774,37.643 L11.476,48.007 C11.541,48.136 11.608,48.264 11.675,48.391 ZM10.491,25.676 C9.219,28.863 8.558,32.279 8.558,35.761 C8.558,39.250 9.220,42.587 10.422,45.655 L16.531,35.602 L10.491,25.676 ZM11.778,23.019 C11.756,23.019 11.736,23.023 11.718,23.028 C11.664,23.129 11.610,23.231 11.557,23.333 C11.563,23.348 11.567,23.362 11.577,23.378 L17.772,33.559 L24.178,23.019 L11.778,23.019 ZM19.014,35.601 L26.798,48.391 L44.477,48.391 L52.220,35.601 L44.574,23.019 L26.660,23.019 L19.014,35.601 ZM27.950,20.897 L43.285,20.897 L35.819,8.612 C35.806,8.590 35.791,8.573 35.775,8.559 C35.770,8.559 35.765,8.558 35.760,8.558 C35.659,8.558 35.557,8.562 35.455,8.563 C35.441,8.577 35.427,8.592 35.415,8.612 L27.950,20.897 ZM45.214,37.193 L37.193,45.214 C36.726,45.681 36.113,45.914 35.500,45.914 C34.887,45.914 34.274,45.681 33.807,45.214 L25.786,37.193 C24.852,36.259 24.852,34.740 25.786,33.806 L33.807,25.785 C34.740,24.852 36.259,24.852 37.193,25.785 L45.214,33.806 C46.148,34.740 46.148,36.259 45.214,37.193 ZM43.714,35.307 L35.693,27.285 C35.640,27.232 35.570,27.206 35.500,27.206 C35.430,27.206 35.360,27.232 35.307,27.285 L27.286,35.307 C27.179,35.413 27.179,35.586 27.286,35.693 L35.307,43.714 C35.413,43.821 35.587,43.821 35.693,43.714 L43.714,35.693 C43.821,35.586 43.821,35.413 43.714,35.307 ZM35.500,39.262 C33.426,39.262 31.738,37.574 31.738,35.500 C31.738,33.425 33.426,31.737 35.500,31.737 C37.574,31.737 39.262,33.425 39.262,35.500 C39.262,37.574 37.574,39.262 35.500,39.262 ZM35.500,33.859 C34.595,33.859 33.859,34.595 33.859,35.500 C33.859,36.404 34.595,37.140 35.500,37.140 C36.405,37.140 37.141,36.404 37.141,35.500 C37.141,34.595 36.405,33.859 35.500,33.859 Z" class="cls-1"/> </svg>                          
                                    </span>
        
                                    <h4 class="as_subheading">Kundli Dosha </h4>
                                    <p class="as_paddingBottom10">Lorem ipsum dolor sit <br>amet, consectetur</p>
                                    <a href="service_single.html" class="as_link">read more 
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="7" viewBox="0 0 12 7"> <path class="cls-1" d="M8.966,4.52H1.312A1.644,1.644,0,0,1,.976,4.5,0.656,0.656,0,0,1,.447,3.8a0.672,0.672,0,0,1,.7-0.575q2.824,0,5.649,0c0.7,0,1.4,0,2.13-.051C8.546,2.814,8.166,2.455,7.782,2.1A0.675,0.675,0,0,1,7.523,1.5,0.629,0.629,0,0,1,7.981.959a0.688,0.688,0,0,1,.726.187L10.429,2.8l0.58,0.557a0.637,0.637,0,0,1,.011,1.016q-1.149,1.109-2.3,2.212a0.7,0.7,0,0,1-1.006.036A0.635,0.635,0,0,1,7.77,5.658C8.151,5.294,8.533,4.932,8.966,4.52Z"/> </svg>
                                        </span>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="as_service_box text-center">
                                    <span class="as_icon">
                                       <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="70" height="70" viewBox="0 0 70 70"> <path d="M70.000,67.742 L70.000,70.000 L-0.000,70.000 L-0.000,67.742 L10.161,67.742 L10.161,49.677 L7.903,49.677 L7.903,42.903 L12.419,42.903 L12.419,38.684 C12.419,36.677 13.766,34.891 15.695,34.341 L20.322,33.021 L20.322,31.003 C18.941,29.761 18.064,27.967 18.064,25.967 L18.064,23.710 C18.064,19.973 21.103,16.935 24.839,16.935 C28.575,16.935 31.613,19.973 31.613,23.710 L31.613,25.967 C31.613,27.968 30.737,29.762 29.355,31.003 L29.355,33.020 L33.983,34.341 C35.814,34.864 37.107,36.505 37.233,38.387 L43.565,38.387 L49.624,32.327 C47.025,31.379 45.161,28.890 45.161,25.967 L45.161,23.710 C45.161,19.973 48.199,16.935 51.935,16.935 C55.671,16.935 58.710,19.973 58.710,23.710 L58.710,25.967 C58.710,27.939 57.858,29.710 56.510,30.949 C57.866,31.656 58.710,33.034 58.710,34.569 L58.710,36.129 L63.226,36.129 L63.226,50.806 C63.226,54.742 60.330,58.006 56.560,58.602 L57.473,67.742 L70.000,67.742 ZM52.957,67.742 L55.204,67.742 L54.301,58.709 L52.054,58.709 L52.957,67.742 ZM44.032,67.742 L50.688,67.742 L49.785,58.709 L44.032,58.709 L44.032,67.742 ZM36.560,67.742 L35.431,65.484 L18.762,65.484 L17.633,67.742 L36.560,67.742 ZM12.419,51.935 L15.806,51.935 L15.806,54.193 L12.419,54.193 L12.419,67.742 L15.108,67.742 L17.366,63.225 L36.827,63.225 L39.085,67.742 L41.774,67.742 L41.774,54.193 L18.064,54.193 L18.064,51.935 L41.774,51.935 L41.774,49.677 L12.419,49.677 L12.419,51.935 ZM10.161,45.161 L10.161,47.419 L45.161,47.419 L45.161,45.161 L10.161,45.161 ZM29.355,23.710 C29.355,21.219 27.329,19.193 24.839,19.193 C22.348,19.193 20.322,21.219 20.322,23.710 L20.322,25.967 C20.322,28.458 22.348,30.484 24.839,30.484 C27.329,30.484 29.355,28.458 29.355,25.967 L29.355,23.710 ZM22.581,32.347 L22.581,33.559 C22.861,33.991 23.639,35.000 24.839,35.000 C26.039,35.000 26.817,33.991 27.097,33.559 L27.097,32.347 C26.389,32.597 25.631,32.742 24.839,32.742 C24.046,32.742 23.288,32.597 22.581,32.347 ZM33.363,36.512 L28.711,35.183 C28.057,36.037 26.782,37.258 24.839,37.258 C22.895,37.258 21.621,36.037 20.966,35.184 L16.315,36.513 C15.352,36.788 14.677,37.680 14.677,38.684 L14.677,42.902 L30.692,42.902 C30.565,42.547 30.484,42.170 30.484,41.773 C30.484,39.906 32.004,38.386 33.871,38.386 L34.951,38.386 C34.831,37.511 34.228,36.759 33.363,36.512 ZM44.500,40.645 L33.871,40.645 C33.248,40.645 32.742,41.151 32.742,41.774 C32.742,42.397 33.248,42.903 33.871,42.903 L45.823,42.903 L53.823,34.903 C54.059,34.667 54.193,34.341 54.193,34.008 C54.193,33.309 53.626,32.742 52.928,32.742 C52.595,32.742 52.268,32.876 52.032,33.112 L44.500,40.645 ZM56.452,23.710 C56.452,21.219 54.426,19.193 51.935,19.193 C49.445,19.193 47.419,21.219 47.419,23.710 L47.419,25.967 C47.419,28.458 49.445,30.484 51.935,30.484 C54.426,30.484 56.452,28.458 56.452,25.967 L56.452,23.710 ZM56.452,34.569 C56.452,34.487 56.429,34.413 56.419,34.334 C56.342,35.144 55.998,35.921 55.420,36.499 L47.419,44.500 L47.419,49.677 L44.032,49.677 L44.032,51.935 L53.064,51.935 C54.932,51.935 56.452,50.416 56.452,48.548 L56.452,34.569 ZM60.968,50.806 L60.968,38.387 L58.710,38.387 L58.710,48.548 C58.710,51.661 56.177,54.193 53.064,54.193 L44.032,54.193 L44.032,56.451 L55.323,56.451 C58.435,56.451 60.968,53.919 60.968,50.806 ZM35.000,18.216 L35.000,11.290 L27.097,11.290 L27.097,-0.000 L54.193,-0.000 L54.193,11.290 L43.312,11.290 L35.000,18.216 ZM51.935,2.258 L29.355,2.258 L29.355,9.032 L37.258,9.032 L37.258,13.396 L42.495,9.032 L51.935,9.032 L51.935,2.258 ZM36.129,4.516 L45.161,4.516 L45.161,6.774 L36.129,6.774 L36.129,4.516 ZM49.677,6.774 L47.419,6.774 L47.419,4.516 L49.677,4.516 L49.677,6.774 ZM31.613,4.516 L33.871,4.516 L33.871,6.774 L31.613,6.774 L31.613,4.516 Z" class="cls-1"/> </svg>                                 
                                    </span>
        
                                    <h4 class="as_subheading">Kundli Dosha </h4>
                                    <p class="as_paddingBottom10">Lorem ipsum dolor sit <br>amet, consectetur</p>
                                    <a href="service_single.html" class="as_link">read more 
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="7" viewBox="0 0 12 7"> <path class="cls-1" d="M8.966,4.52H1.312A1.644,1.644,0,0,1,.976,4.5,0.656,0.656,0,0,1,.447,3.8a0.672,0.672,0,0,1,.7-0.575q2.824,0,5.649,0c0.7,0,1.4,0,2.13-.051C8.546,2.814,8.166,2.455,7.782,2.1A0.675,0.675,0,0,1,7.523,1.5,0.629,0.629,0,0,1,7.981.959a0.688,0.688,0,0,1,.726.187L10.429,2.8l0.58,0.557a0.637,0.637,0,0,1,.011,1.016q-1.149,1.109-2.3,2.212a0.7,0.7,0,0,1-1.006.036A0.635,0.635,0,0,1,7.77,5.658C8.151,5.294,8.533,4.932,8.966,4.52Z"/> </svg>
                                        </span>
                                    </a>
                                </div>
                            </div>
                            
                        </div>
                   </div>
                </div>
            </div>
        </section>

        <section class="as_whychoose_wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 text-center">
                        <h1 class="as_heading">Why Choose Us</h1>
                        <span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="240" height="15" viewBox="0 0 240 15"> <image id="Design" width="240" height="15" xlink:href="data:img/png;base64,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"/> </svg>
                          </span>  
                        <p class="as_font14 as_padderTop20 as_padderBottom50">It is a long established fact that a reader will be distracted by the readable content of a page <br>when looking at its layout. The point of using Lorem Ipsum .</p>
                    </div>
                    <div class="col-lg-12">
                        <ul class="as_choose_ul">
                            <li>
                                <div class="as_whychoose_box text-center">
                                    <span class="as_number"><span><span data-from="0" data-to="100"
                                        data-speed="5000">100</span>+</span><img src="{{asset('frontend/assets/images/svg/choose.svg')}}" alt=""></span>
                                    <h4>Trusted by Million Clients</h4>
                                </div>
                            </li>
                            <li>
                                <div class="as_whychoose_box text-center">
                                    <span class="as_number"><span><span data-from="0" data-to="30"
                                        data-speed="5000">30</span>+</span><img src="{{asset('frontend/assets/images/svg/choose.svg')}}" alt=""></span>
                                    <h4>Years of Experience</h4>
                                </div>
                            </li>
                            <li>
                                <div class="as_whychoose_box text-center">
                                    <span class="as_number"><span><span data-from="0" data-to="55"
                                        data-speed="5000">55</span>+</span><img src="{{asset('frontend/assets/images/svg/choose.svg')}}" alt=""></span>
                                    <h4>Types of Horoscopes</h4>
                                </div>
                            </li>
                            <li>
                                <div class="as_whychoose_box text-center">
                                    <span class="as_number"><span><span data-from="0" data-to="90"
                                        data-speed="5000">90</span>+</span><img src="{{asset('frontend/assets/images/svg/choose.svg')}}" alt=""></span>
                                    <h4>Qualified Astrologers</h4>
                                </div>
                            </li>
                            <li>
                                <div class="as_whychoose_box text-center">
                                    <span class="as_number"><span><span data-from="0" data-to="99"
                                        data-speed="5000">99</span>+</span><img src="{{asset('frontend/assets/images/svg/choose.svg')}}" alt=""></span>
                                    <h4>Success Horoscope</h4>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section class="as_pricing_plan as_padderBottom50 as_padderTop80">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h1 class="as_heading as_heading_center">Our Pricing Plan</h1>
                        <span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="240" height="15" viewBox="0 0 240 15">
                            <image id="Vector_Smart_Object" data-name="Vector Smart Object" width="240" height="15" xlink:href="data:img/png;base64,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"/>
                          </svg>
                          </span>
                        <p class="as_font14 as_padderBottom50 as_padderTop20">Consectetur adipiscing elit, sed do eiusmod tempor incididuesdeentiut labore <br>etesde dolore magna aliquapspendisse and the gravida.</p>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="as_pricing_box text-center">
                            <div class="as_pric_icon">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="79" height="79" viewBox="0 0 79 79"></svg>
                            </div>
                            <div class="as_pricing as_gradient_text">
                                <sup class="as_gradient_text">$</sup>10 <sub class="as_gradient_text">/ Per Day</sub>
                            </div>
                            <h1 class="as_heading as_gradient_text">Standard Plan</h1>
                            <ul>
                                  <li>Ask One Question</li>
                                  <li>Half-Hour Reading</li>  
                                  <li class="as_inactive"> Newborn / Child <br> Reading</li> 
                                  <li class="as_inactive">Relationship Reading</li>
                            </ul>

                            <a href="javascript:;" class="as_btn">Choose Now</a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="as_pricing_box text-center">
                            <div class="as_pric_icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="78" height="75" viewBox="0 0 78 75"></svg>
                            </div>
                            <div class="as_pricing as_gradient_text">
                                <sup class="as_gradient_text">$</sup>45 <sub class="as_gradient_text">/ Per Day</sub>
                            </div>
                            <h1 class="as_heading as_gradient_text">Pro Plan</h1>
                            <ul>
                                  <li>Ask One Question</li>
                                  <li>Half-Hour Reading</li>  
                                  <li class="as_inactive"> Newborn / Child <br> Reading</li> 
                                  <li class="as_inactive">Relationship Reading</li>
                            </ul>

                            <a href="javascript:;" class="as_btn">Choose Now</a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="as_pricing_box text-center">
                            <div class="as_pric_icon">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="85.06" height="84.94" viewBox="0 0 85.06 84.94"></svg>
                            </div>
                            <div class="as_pricing as_gradient_text">
                                <sup class="as_gradient_text">$</sup>80 <sub class="as_gradient_text">/ Per Day</sub>
                            </div>
                            <h1 class="as_heading as_gradient_text">Premium Plan</h1>
                            <ul>
                                  <li>Ask One Question</li>
                                  <li>Half-Hour Reading</li>  
                                  <li> Newborn / Child <br> Reading</li> 
                                  <li>Relationship Reading</li>
                            </ul>

                            <a href="javascript:;" class="as_btn">Choose Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="as_customer_wrapper as_padderBottom80 as_padderTop80">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h1 class="as_heading as_heading_center">What My Client Say</h1>
                        <span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="240" height="15" viewBox="0 0 240 15">
                            <image id="Vector_Smart_Object" data-name="Vector Smart Object" width="240" height="15" xlink:href="data:img/png;base64,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"/>
                          </svg>
                          </span>
                        <p class="as_font14 as_padderBottom50 as_padderTop20">Consectetur adipiscing elit, sed do eiusmod tempor incididuesdeentiut labore <br>etesde dolore magna aliquapspendisse and the gravida.</p>

                        <div class="row as_customer_slider">
                            <div class="col-lg-5 col-md-5 as_customer_nav">
                                <div class="as_customer_img">
                                    <img src="{{asset('frontend/assets/images/c1.jpg')}}" alt="" class="img-responsive">
                                </div>
                                <div class="as_customer_img">
                                    <img src="{{asset('frontend/assets/images/c2.jpg')}}" alt="" class="img-responsive">
                                </div>
                                <div class="as_customer_img">
                                    <img src="{{asset('frontend/assets/images/c3.jpg')}}" alt="" class="img-responsive">
                                </div>
                                <div class="as_customer_img">
                                    <img src="{{asset('frontend/assets/images/c4.jpg')}}" alt="" class="img-responsive">
                                </div>
                                <div class="as_customer_img">
                                    <img src="{{asset('frontend/assets/images/c5.jpg')}}" alt="" class="img-responsive">
                                </div>
                                <div class="as_customer_img">
                                    <img src="{{asset('frontend/assets/images/c6.jpg')}}" alt="" class="img-responsive">
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-7 as_customer_for">
                                <div class="as_customer_box text-center">
                                    <p class="as_margin0">“Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis.”</p>
                                    <h3>A. Dennett - <span>Astrologer</span></h3>
                                </div>
                                <div class="as_customer_box text-center">
                                    <p class="as_margin0">“Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis.”</p>
                                    <h3>R. Lilly - <span>Astrologer</span></h3>
                                </div>
                                <div class="as_customer_box text-center">
                                    <p class="as_margin0">“Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis.”</p>
                                    <h3>David Parker - <span>Astrologer</span></h3>
                                </div>
                                <div class="as_customer_box text-center">
                                    <p class="as_margin0">“Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis.”</p>
                                    <h3>David Lee - <span>Astrologer</span></h3>
                                </div>
                                <div class="as_customer_box text-center">
                                    <p class="as_margin0">“Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis.”</p>
                                    <h3>H. Wang - <span>Astrologer</span></h3>
                                </div>
                                <div class="as_customer_box text-center">
                                    <p class="as_margin0">“Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis.”</p>
                                    <h3>G. Zirkle - <span>Astrologer</span></h3>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
@endsection