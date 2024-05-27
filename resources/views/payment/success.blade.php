
@extends('layouts.frontend.app')

@section('title','Successful')

@push('css_or_js')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush
@section('content')
       <section class="">
            <div class="container">
                <div class="row">
                   <h1 style="margin-top: 172px;
    margin-bottom: 26px;">Booking Successful!</h1>
                </div>
            </div>
        </section>




@endsection