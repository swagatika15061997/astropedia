@extends('layouts.frontend.app')
@section('title','Yesterday Horoscope')
@push('css_or_js')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        /* Custom CSS to ensure inline display */
.inline-content {
    display: flex;
    padding: 20px;
}

.zodiac-image {
    flex: 0 0 auto; /* Prevent image from growing */
    margin-right: 15px; /* Add some space between image and content */
    
}
.image-zodiac {
    width: 76px;
    height: 76px;
    padding: 5px;
    border: 1px solid #c1c1c1;
    border-radius: 5px;
}
.zodiac-content {
    flex: 1; /* Let content occupy remaining space */
}
.zodiac-content h5{
    color: #000;
}
.zodiac-card {
    margin-bottom: 25px;
    box-shadow: 0 0 10px rgb(255 214 0 / 29%);
}


    </style>
@endpush
@section('content')
<section class="as_breadcrum_wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h1>Yesterday's Horoscope</h1> 

                        <ul class="breadcrumb"> 
                            <li><a href="/">Home</a></li>
                            <li>Yesterday's Horoscope</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        
        <section class="as_blog_wrapper as_padderBottom90 as_padderTop80">
            <div class="container">
                <div class="row">
                    @foreach($zodiacSigns as $zodiacSign)
                    <div class="col-lg-6">
                        <div class="card zodiac-card">
                          <div class="inline-content">
                              <div class="zodiac-image">
                                  <img src="{{asset('images/horoscope/'.$zodiacSign->image)}}" class="image-zodiac" alt="{{$zodiacSign->name}}">
                              </div>
                              <div class="zodiac-content">
                                  <h5>{{$zodiacSign->name}} Yesterday's Horoscope</h5>
                                  @if ($zodiacSign->dailyHoroscope)
                                  <div class="zodiac-content" style="display: flex;">
                                     <!-- <p>{{ $zodiacSign->dailyHoroscope->category }}:</p> -->
                                     <p>Career:</p>
                                     <p>{!! substr($zodiacSign->dailyHoroscope->description, 0, 210) !!}... <span><a href="{{route('horoscope.details',['zodiac_sign_id' => $zodiacSign->id,'horoscopeDate' => $yesterday])}}"><b>read more</b></a></span></p>
                                  </div>                                  
                                  @else
                                    <p>No horoscope available for yesterday.</p>
                                  @endif
                              </div>
                          </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>     
@endsection