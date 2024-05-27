@extends('layouts.frontend.app')
@section('title','Horoscope details')
@push('css_or_js')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        li.active {
    color: #f7d003;
}
.as_shop_sidebar {
    background: #eee;
    border-radius: 5px;
    padding: 25px;
}
.zodiac-sign-container {
    position: relative;
    width: 100px !important; /* Adjust width as needed */
    height: 100px; /* Adjust height as needed */
    border-radius: 50%;
    overflow: hidden; /* Ensures the image stays within the rounded border */
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5); /* Adds a shadow effect */
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 10px;
    margin-bottom: 10px;
}

.horizontal-line {
    position: absolute;
    height: 2px; /* Adjust line thickness as needed */
    background-color: #f0f0f0; /* Adjust line color as needed */
    width: calc(50% - 50px); /* Adjust line width as needed */
    top: calc(50% - 1px); /* Vertically center the line */
}

.left-line {
    left: 0;
}

.right-line {
    right: 0;
}

.image-zodiac {
    max-width: 100%; /* Ensures the image stays within the container */
    max-height: 100%; /* Ensures the image stays within the container */
    display: block; /* Ensures the image is treated as a block-level element */
    border-radius: 50%; /* Ensures the image is circular */
}



    </style>
@endpush
@section('content')
<section class="as_breadcrum_wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h1>Horoscope</h1> 

                        <ul class="breadcrumb"> 
                            <li><a href="/">Home</a></li>
                            <li>Horoscope</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <!-- <div class="container zodiac-sign-container">
            @if(!$todayHoroscope->isEmpty())
                @foreach($todayHoroscope as $t_h)
                    @php
                        $zodiacSign = $t_h->image;
                    @endphp
                    @if($zodiacSign)
                        <img src="{{ asset('images/horoscope/' . $zodiacSign) }}" class="image-zodiac" alt="{{ $zodiacSign}}">
                        @break
                    @endif
                @endforeach
            @elseif(!$yesterDayHoroscope->isEmpty())
                @foreach($yesterDayHoroscope as $y_h)
                    @php
                        $zodiacSign = $y_h->image;
                    @endphp
                    @if($zodiacSign)
                        <img src="{{ asset('images/horoscope/' . $zodiacSign) }}" class="image-zodiac" alt="{{ $zodiacSign }}">
                        @break
                    @endif
                @endforeach
            @elseif(!$tomorrowHoroscope->isEmpty())
                @foreach($tomorrowHoroscope as $to_h)
                    @php
                        $zodiacSign = $to_h->image;
                    @endphp
                    @if($zodiacSign)
                        <img src="{{ asset('images/horoscope/' . $zodiacSign) }}" class="image-zodiac" alt="{{ $zodiacSign }}">
                        @break
                    @endif
                @endforeach
            @elseif(!$weeklyHoroScope->isEmpty())
                @foreach($weeklyHoroScope as $w_h)
                    @php
                        $zodiacSign = $w_h->image;
                    @endphp
                    @if($zodiacSign)
                        <img src="{{ asset('images/horoscope/' . $zodiacSign) }}" class="image-zodiac" alt="{{ $zodiacSign }}">
                        @break
                    @endif
                @endforeach
            @elseif(!$monthlyHoroScope->isEmpty())
                @foreach($monthlyHoroScope as $m_h)
                    @php
                        $zodiacSign = $m_h->image;
                    @endphp
                    @if($zodiacSign)
                        <img src="{{ asset('images/horoscope/' . $zodiacSign) }}" class="image-zodiac" alt="{{ $zodiacSign }}">
                        @break
                    @endif
                @endforeach
            @elseif(!$yearlyHoroScope->isEmpty())
                @foreach($yearlyHoroScope as $yr_h)
                    @php
                        $zodiacSign = $yr_h->image;
                    @endphp
                    @if($zodiacSign)
                        <img src="{{ asset('images/horoscope/' . $zodiacSign) }}" class="image-zodiac" alt="{{ $zodiacSign }}">
                        @break
                    @endif
                @endforeach
            @endif
        </div> -->
        <section class="as_blog_wrapper as_padderBottom90 as_padderTop80">
           <div class="container">
               <div class="row">
                   <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
                       <div class="as_shop_sidebar">
                           <div class="as_widget as_search_widget">
                               <div class="form-group">
                                   <h3 class="as_widget_title">Select Other Sign:</h3>
                                   <!-- <div class="as_select_box"> -->
                                   <select name="zodiacSignId" id="zodiacSignId" class="form-control">
                                       @foreach($zodiac_signs as $zodiac_sign)
                                           <option value="{{ $zodiac_sign->id }}" {{ $zodiac_sign->id == request()->query('zodiac_sign_id') ? 'selected' : '' }}>
                                               {{ $zodiac_sign->name }}
                                           </option>
                                       @endforeach
                                   </select>
                                       
                                   <!-- </div>  -->
                               </div>
                           </div>
                           <div class="as_widget as_category_widget">
                               <h3 class="as_widget_title">Horoscopes:</h3>
                               <ul id="horoscopeTypes">
                                 <li class="{{ request()->query('horoscopeDate') === date('Y-m-d') ? 'active' : '' }}"><a href="{{ route('horoscope.details', ['zodiac_sign_id' => request()->query('zodiac_sign_id'), 'horoscopeDate' => date('Y-m-d')]) }}" data-type="today">Today's Horoscope</a></li>
                                 <li class="{{ request()->query('horoscopeDate') === date('Y-m-d', strtotime('+1 day')) ? 'active' : '' }}"><a href="{{ route('horoscope.details', ['zodiac_sign_id' => request()->query('zodiac_sign_id'), 'horoscopeDate' => date('Y-m-d', strtotime('+1 day'))]) }}" data-type="tomorrow">Tomorrow's Horoscope</a></li>
                                 <li class="{{ request()->query('horoscopeDate') === date('Y-m-d', strtotime('-1 day')) ? 'active' : '' }}"><a href="{{ route('horoscope.details', ['zodiac_sign_id' => request()->query('zodiac_sign_id'), 'horoscopeDate' => date('Y-m-d', strtotime('-1 day'))]) }}" data-type="yesterday">Yesterday's Horoscope</a></li>
                                 <li class="{{ request()->query('horoscopeType') === 'Weekly' ? 'active' : '' }}"><a href="{{ route('horoscope.details', ['zodiac_sign_id' => request()->query('zodiac_sign_id'), 'horoscopeType' => 'Weekly']) }}" data-type="weekly">Weekly Horoscope</a></li>
                                 <li class="{{ request()->query('horoscopeType') === 'Monthly' ? 'active' : '' }}"><a href="{{ route('horoscope.details', ['zodiac_sign_id' => request()->query('zodiac_sign_id'), 'horoscopeType' => 'Monthly']) }}" data-type="monthly">Monthly Horoscope</a></li>
                                 <li class="{{ request()->query('horoscopeType') === 'Yearly' ? 'active' : '' }}"><a href="{{ route('horoscope.details', ['zodiac_sign_id' => request()->query('zodiac_sign_id'), 'horoscopeType' => 'Yearly']) }}" data-type="yearly">Yearly horoscope</a></li>
                               </ul>
                           </div>
                       </div>
                   </div>
                   <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12">
                       <div class="as_service_single">
                           <h3>Horoscope Details</h3>
                           @if(!$yesterDayHoroscope->isEmpty())
                            @foreach($yesterHoroscopeStatics as $yesterHoroscopeStatic)
                             <p>Lucky Time: {{$yesterHoroscopeStatic->luckyTime}}</p>
                             <p>Lucky number: {{$yesterHoroscopeStatic->luckyNumber}}</p>
                             <p>Lucky color: <span style="background-color: {{$yesterHoroscopeStatic->luckyColor}};color:{{$yesterHoroscopeStatic->luckyColor}}">color</span></p>
                             @endforeach
                            @foreach($yesterDayHoroscope as $y_h)
                             <h5>{{$y_h->category}}:</h5>
                             <p>{!!$y_h->description!!}</p>
                             @endforeach
                           @elseif(!$tomorrowHoroscope->isEmpty())
                            @foreach($tomorrowHoroscopeStatics as $tomorrowHoroscopeStatic)
                             <p>Lucky Time: {{$tomorrowHoroscopeStatic->luckyTime}}</p>
                             <p>Lucky number: {{$tomorrowHoroscopeStatic->luckyNumber}}</p>
                             <p>Lucky color: <span style="background-color: {{$tomorrowHoroscopeStatic->luckyColor}};color:{{$tomorrowHoroscopeStatic->luckyColor}}">color</span></p>
                             @endforeach
                            @foreach($tomorrowHoroscope as $to_h)
                             <h5>{{$to_h->category}}:</h5>
                             <p>{!!$to_h->description!!}</p>
                             @endforeach
                           @elseif(!$weeklyHoroScope->isEmpty())
                            @foreach($weeklyHoroScope as $weekly)
                             <h5>{{$weekly->title}}:</h5>
                             <p>{!!$weekly->description!!}</p>
                             @endforeach
                           @endif
                          
                           
                       </div>
                   </div>
               </div>
           </div>
       </section>
@endsection
@push('script')
<!-- <script>
$(document).ready(function() {
    $('#horoscopeTypes li a').on('click', function() {
        var zodiacSignId = $('#zodiacSignId').val();
        var type = $(this).data('type');

        $.ajax({
            url: '/horoscope/daily-horo/' + zodiacSignId + '/' + type,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                console.log(response.horoscope);
                var horoscopeHTML = '<h3>Horoscope</h3>';
                // Display horoscope data
                if (type === 'weekly' || type === 'monthly' || type === 'yearly') {
                    // Display horoscope data
                    $.each(response.horoscope, function(index, horoscope) {
                        horoscopeHTML += '<h4>' + horoscope.title + '</h4>';
                        horoscopeHTML += '<p>' + horoscope.description + '</p>';
                    });
                } else {
                $.each(response.statics, function(index, statics) {
                    horoscopeHTML += '<p>Lucky Time: ' + statics.luckyTime + '</p>';
                    horoscopeHTML += '<p>Lucky Number: ' + statics.luckyNumber + '</p>';
                    horoscopeHTML += '<p>Lucky Color: <span style="background-color: ' + statics.luckyColor + '; color: ' + statics.luckyColor + ';">'+ statics.luckyColor +'</span></p>';
                    
                });
                $.each(response.horoscope, function(index, horoscope) {
                    horoscopeHTML += '<h4>' + horoscope.category + '</h4>';
                    horoscopeHTML += '<p>' + horoscope.description + '</p>';
                    horoscopeHTML += '<p>Percentage: ' + horoscope.percentage + '</p>';
                });
            }
                // Display statics data
                
                
                $('.as_service_single').html(horoscopeHTML);
            }
        });
    });
});
</script> -->
<script>
    // Add event listener to the select element
    document.getElementById('zodiacSignId').addEventListener('change', function() {
        // Get the selected option value
        var selectedValue = this.value;
        // Parse the current URL
        var url = new URL(window.location.href);
        // Update the zodiac_sign_id parameter
        url.searchParams.set('zodiac_sign_id', selectedValue);
        // Redirect the user to the new URL
        window.location.href = url.toString();
    });
</script>
@endpush