
@extends('layouts.frontend.app')

@section('title','Registration')

@push('css_or_js')
  <style>
    .form-c > span {
    position: absolute;
    right: 20px;
    top: 7px;
}
  </style>  
@endpush
@section('content')
<section class="as_about_wrapper as_padderTop80 as_padderBottom80 mb-10">
  <div class="container">
   <div class="card w-75 mb-3 ml-5 shadow-lg" style="margin: 120px auto 10px;">
     <div class="card-body">
       <h5 class="card-title text-center text-dark mb-4">Register</h5>
       <x-auth-session-status class="mb-4" :status="session('status')" />
        <form method="POST" action="{{ route('register') }}">
           @csrf
           <div class="row">
             
             <div class="col-lg-6">
              <div class="mb-3">
                <label for="username" class="form-label">Name</label>
                <input type="text" class="form-control rounded" id="name" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
              </div>
             </div>
             <div class="col-lg-6">
               <div class="mb-3">
                 <label for="email" class="form-label">Email Address</label>
                 <input id="email" class="form-control rounded" type="email" name="email" :value="old('email')" required autocomplete="username" />
                 <x-input-error :messages="$errors->get('email')" class="mt-2" />
               </div>
             </div>
             <div class="col-lg-6">
               <div class="mb-3">
                 <label for="password">Password</label>
                 <input type="password" class="form-control rounded" id="password" type="password"
                                 name="password"
                                 required autocomplete="new-password" />
                 <x-input-error :messages="$errors->get('password')" class="mt-2" />
               </div>
             </div>
             <div class="col-lg-6">
               <div class="mb-3">
                 <label for="cpassword">Confirm Password</label>
                 <input type="password" class="form-control rounded" id="password_confirmation"
                                 name="password_confirmation" required autocomplete="new-password" />
                 <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
               </div>
             </div>
             <div class="col-lg-12">
               <div class="mb-3">
                 <label for="phone">Phone number</label>
                 <input type="text" class="form-control rounded" id="phone" name="phone" required="required" />
               </div>
             </div>
             <div class="col-lg-6">
              <div class="mb-3 form-c">
                 <label for="dob">Date of Birth</label>
                 <input type="text" name="dob" placeholder="Date of Birth" class="form-control rounded as_datepicker">
                                           <!-- <span><img src="{{asset('frontend/assets/images/svg/calendar.svg')}}" alt=""></span> -->
               </div>
             </div>
             <div class="col-lg-6">
               <div class="mb-3 form-c">
                 <label for="dot">Time of Birth</label>
                 <input type="text" name="dot" placeholder="Time of Birth" class="form-control rounded as_timepicker">
                 <!-- <span><img src="{{asset('frontend/assets/images/svg/clock.svg')}}" alt=""></span> -->
               </div>
             </div>
             <div class="col-lg-6"></div>
           </div>
           
           
           <div class="form-group">
               <button class="btn btn-outline-warning" type="submit">Register</button>
           </div>
         </form>
     </div>
   </div>
 </div>
</section>

@endsection
