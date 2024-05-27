@extends('layouts.frontend.app')

@section('title','Profile')

@push('css_or_js')
@vite(['resources/css/app.css', 'resources/js/app.js'])
<style>
    img{
        display:inline !important;
    }
    .py-12{
        padding-top: 0rem !important;
    }
</style>
@endpush
@section('content')
<section class="as_padderTop80 as_padderBottom80 page_margin" style="margin-top: 133px;">
    <div class="container">
        <h3 style="text-align: center;color:#000">Profile Info</h3>
        <div class="row">
           @include('layouts.frontend.partial.side-bar')
           <div class="col-lg-8">
                <div class="py-12" >
                    <div class="max-w-7xl mx-auto sm:px-4 lg:px-8 space-y-6">
                        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                            <div class="max-w-xl">
                                @include('profile.partials.update-profile-information-form')
                            </div>
                        </div>
            
                        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                            <div class="max-w-xl">
                                @include('profile.partials.update-password-form')
                            </div>
                        </div>
            
                        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                            <div class="max-w-xl">
                                @include('profile.partials.delete-user-form')
                            </div>
                        </div>
                    </div>
                </div>
           </div>
        </div> 
    </div>
</section>
@endsection