@extends('layouts.frontend.app')
@section('title','Weekly Horoscope')
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
                        <h1>Today's Horoscope</h1> 

                        <ul class="breadcrumb"> 
                            <li><a href="/">Home</a></li>
                            <li>Today's Horoscope</li>
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
                                  <h5>{{$zodiacSign->name}} Weekly Horoscope</h5>
                                  @if ($zodiacSign->horoscope)
                                  <div class="zodiac-content" >
                                     <p>{{ $zodiacSign->horoscope->title }} :</p>
                                     <p>{!! substr($zodiacSign->horoscope->description, 0, 210) !!}... <span><a href="{{route('horoscope.details',['zodiac_sign_id' => $zodiacSign->id ,'horoscopeType' => $horoscopeType])}}"><b>read more</b></a></span></p>
                                  </div>                                  
                                  @else
                                    <p>No daily horoscope available for today.</p>
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