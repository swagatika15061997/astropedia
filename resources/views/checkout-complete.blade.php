@extends('layouts.frontend.app')
@section('title','Cart Details')
@push('css_or_js')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .pay{
            padding: 21px;
            align-items: center;
        }
        .g-8{
            padding: 10px;
        }
        .r-2{
            margin-left: 5px
        }
        .card{
            box-shadow: 0px 0px 16px rgba(0, 113, 220, 0.15) !important;
        }
        .__text-100px {
    font-size: 100px !important;
}

.__color-0f9d58 {
    color: #0f9d58;
}
        
    </style>

@endpush
@section('content')
<div class="cart-item" style="margin-top: 225px;">
   <div class="container">
       <div class="row">
        <div class="col-lg-6">
          <h1>Your order has been placed</h1>
        </div>
       </div>
       <div class="row">
            <div class="col-lg-12 col-md-12">
                <center>
                    <i class="fa fa-check-circle __text-100px __color-0f9d58"></i>
                </center>
            </div>
        </div>
        <span class="font-weight-bold d-block mt-4 __text-17px">Hello, {{Auth::user()->name}}</span>
        <span>You order has been confirmed and will be shipped according to the method you selected!</span>
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <a href="{{route('shop')}}" class="btn btn--primary" style="background-color: #ffd600;color: #fff;">
                   Go to shopping
                </a>
            </div>
            <div class="col-lg-6 col-md-6">
                <a href="{{route('order')}}"
                   class="btn btn-secondary" style="background-color: #000;color: #fff;">
                   Check orders
                </a>
            </div>
        </div>
   </div>
</div>


@endsection
@push('script')

@endpush