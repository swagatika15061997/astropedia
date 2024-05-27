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
                        <h1>Horoscope</h1> 

                        <ul class="breadcrumb"> 
                            <li><a href="/">Home</a></li>
                            <li>Horoscope</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        
        <section class="as_blog_wrapper as_padderBottom90 as_padderTop80">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
                <div class="as_shop_sidebar">
                    <?php
                    $zodiac_signs = \App\Models\ZodiacSign::where('status',1)->orderBy('created_at','asc')->get(); // Replace 'Service' with your actual model name and $serviceId with the ID of the service you want to retrieve
                    ?>
                    <div class="as_widget as_search_widget">
                        <div class="form-group">
                            <div class="as_select_box">
                                <select name="zodiacSignId" id="zodiacSignId" class="form-control">
                                    @foreach($zodiac_signs as $zodiac_sign)
                                    <option value="{{$zodiac_sign->id}}">{{$zodiac_sign->name}}</option>
                                    @endforeach
                                </select>
                            </div> 
                        </div>
                    </div>
                    <div class="as_widget as_category_widget">
                        <h3 class="as_widget_title">Horoscopes</h3>
                        <ul id="horoscopeTypes">
                            <li><a href="javascript:;" data-type="today">Today's Horoscope</a></li>
                            <li><a href="javascript:;" data-type="tomorrow">Tomorrow's Horoscope</a></li>
                            <li><a href="javascript:;" data-type="yesterday">Yesterday's Horoscope</a></li>
                            <li><a href="javascript:;" data-type="weekly">Weekly Horoscope</a></li>
                            <li><a href="javascript:;" data-type="monthly">Monthly Horoscope</a></li>
                            <li><a href="javascript:;" data-type="yearly">Yearly horoscope</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12">
                <div class="as_service_single">
                    <h3>Horoscope</h3>
                    @foreach($horoscopeStatics as $horoscopeStatic)
                    <p>Lucky Time: {{$horoscopeStatic->luckyTime}}</p>
                    <p>Lucky number: {{$horoscopeStatic->luckyNumber}}</p>
                    <p>Lucky color: <span style="background-color: {{$horoscopeStatic->luckyColor}};color:{{$horoscopeStatic->luckyColor}}">color</span></p>
                    @endforeach
                    @if($horoscope)
    @foreach($horoscope as $horo)
        @if(isset($horo->title))
            <!-- Data from 'horoscopes' table -->
            <h4>{{$horo->title}}</h4>
            <p>{!!$horo->description!!}</p>
        @elseif(isset($horo->category))
            <!-- Data from 'daily_horoscopes' table -->
            <h4>{{$horo->category}}</h4>
            <p>{!!$horo->description!!}</p>
        @endif
    @endforeach
@else
    <p>No horoscope available.</p>
@endif
                    <!-- <div class="as_service_img">
                        <img src="assets/images/blog_single1.jpg" alt="" class="img-responsive">
                    </div>
                    <h3>Rahu Enters Cancer and Ketu Enters Capricorn.</h3>
                    <p class="as_margin0 as_padderBottom20">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy that walks through our doors.</p>
                    <p>Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy.Various versions have evolved over the years, sometimes by accident, sometimes on purpose.</p>

                    <ul>
                        <li>Uncover many web sites still in their infancy.Various versions have evolved over the years, sometimes by accident, sometimes on purpose.</li>
                        <li>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.</li>
                        <li>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature.</li>
                    </ul>

                    <p class="as_margin0 as_padderBottom50">All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable.</p> -->
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push('script')
<script>
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
</script>
@endpush