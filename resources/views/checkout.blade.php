@extends('layouts.frontend.app')
@section('title','Cart Details')
@push('css_or_js')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .thumbnail {
    position: relative;
    padding: 0px;
    margin-bottom: 20px;
}
.thumbnail img {
    width: 80%;
}
.thumbnail .caption{
    margin: 7px;
}
.main-section{
    background-color: #F8F8F8;
}
.dropdown{
    float:right;
    padding-right: 30px;
}
.btn{
    border:0px;
    margin:10px 0px;
    box-shadow:none !important;
}
.dropdown .dropdown-menu{
    padding:20px;
    top:30px !important;
    width:350px !important;
    left:-110px !important;
    box-shadow:0px 5px 30px black;
}
.total-header-section{
    border-bottom:1px solid #d2d2d2;
}
.total-section p{
    margin-bottom:20px;
}
.cart-detail{
    padding:15px 0px;
}
.cart-detail-img img{
    width:100%;
    height:100%;
    padding-left:15px;
}
.cart-detail-product p{
    margin:0px;
    color:#000;
    font-weight:500;
}
.cart-detail .price{
    font-size:12px;
    margin-right:10px;
    font-weight:500;
}
.cart-detail .count{
    color:#C2C2DC;
}
.checkout{
    border-top:1px solid #d2d2d2;
    padding-top: 15px;
}
.checkout .btn-primary{
    border-radius:50px;
    height:50px;
}
.dropdown-menu:before{
    content: " ";
    position:absolute;
    top:-20px;
    right:50px;
    border:10px solid transparent;
    border-bottom-color:#fff;
}
thead{
    background: #eee !important;
    border-style: none !important;
}
.quantity{
    margin: 0px !important;
}

/*  */
.content{
  color:#000;
}
form {
  /* padding: 2rem 1rem 1rem; */
  margin: 0 auto;
  max-width: 42rem;
  width: 100%;
  background: #fff;
  /*  removes white space from inline-block els  */
}

fieldset {
  border: 0.15rem solid transparent;
  -o-border-image: linear-gradient(to top, #c6ffd6, #47da77, #ffec15);
     border-image: linear-gradient(to top, #c6ffd6, #47da77, #ffec15);
  border-image-slice: 1;
  padding: 1rem;
}

legend {
  font-size: 1.2rem !important;
}


/* input and labels */

.input-wrapper {
  margin: 0;
  position: relative;
  width: 100%;
  max-width: 20rem;
  padding: 0.5rem;
  font-size: 1.01rem;
}

.lg-third {
  max-width: 14rem;
}

label,
input,
button {
  outline: 0;
  border-radius: 0;
}

label,
button {
  cursor: pointer;
}

.form-text-input + label,
.form-text-input,
input[type="checkbox"],
input[type="checkbox"] + label {
  display: inline-block;
  outline: 0;
}

.form-text-input {
  height: 2.4rem;
  width: 100%;
  /* padding-top: 1.5em; */
  padding-left: 0.45em;
  /* padding-bottom: 0.25em; */
  font-size: 1.1rem;
  font-weight: 400;
  letter-spacing: 1px;
  border: 0;
  box-shadow: inset 0 0 0 0.1rem #00e676;
}




/* shipping same as billing */

input[type="checkbox"] {
  margin-left: 1rem;
  opacity: 0;
}

input[type="checkbox"],
input[type="checkbox"] + label {
  color: #272727;
  position: relative;
  padding: 1rem 1rem 0.5rem;
  margin: 1rem 0;
  font-size: 1.01rem;
}

input[type="checkbox"] + label::before,
input[type="checkbox"] + label::after {
  content: '';
  position: absolute;
}

input[type="checkbox"] + label::before {
  height: 1rem;
  width: 1rem;
  background: #fff;
  box-shadow: inset 0 0 0 1px #272727;
  top: 1.15em;
  left: -0.5rem;
}

input[type="checkbox"] + label::after {
  transition: all 0.1s ease-in-out;
}

input[type="checkbox"]:focus + label {
  font-weight: 700;
  border-bottom: 0.25em solid #00e676;
}

input[type="checkbox"]:checked + label {
  font-weight: 700;
}

input[type="checkbox"]:checked + label::before {
  background: #00e676;
  box-shadow: inset 0 0 0 1px #00e676;
}

input[type="checkbox"]:checked + label::after {
  height: 0.8rem;
  width: 0.256rem;
  border-color: #262c37;
  border-style: solid;
  border-width: 0 0.125rem 0.125rem 0;
  border-radius: 0.125rem;
  left: -0.15rem;
  top: 1em;
  transform: rotate(36deg);
}


/* hiding the billing section if checkbox is checked */

input[type="checkbox"]:checked ~ fieldset {
  display: none;
}


/* submit section */

.submit-wrap {
  margin: auto;
  max-width: 35rem;
}

.btn {
  display: block;
  position: relative;
  z-index: 2;
  padding: 1rem;
  /* width: 100%; */
  margin: 2rem 0 1rem;
  border: 5px solid #00e676;
  border-radius: 0;
  background: #00e676;
  color: #262c37;
  font-size: 1.2rem;
  text-transform: uppercase;
  font-weight: 700;
  transition: all 0.2s ease-in-out;
  overflow: hidden;
}

.btn::before {
  content: '';
  position: absolute;
  width: 100%;
  height: 100%;
  background: #00e676;
  top: 0;
  left: 0;
  z-index: -1;
  transform: translateX(-100%);
  transition: transform 0.4s cubic-bezier(0, .61, .89, .3);
}

.btn:focus,
.btn:hover {
  background: transparent;
  color: #272727;
  border: 5px solid #272727;
}

.btn:active::before {
  transform: translateX(0);
}

.btn:active {
  transform: translateY(2px);
}

@media screen and (min-width: 40rem) {

  .input-wrapper {
    display: inline-block;
  }
  .lg-half {
    width: 50%;
  }
  .lg-third {
    width: 33.3333%;
  }
  .two-thirds {
    width: 66.6666%;
  }
  .btn,
  legend {
    font-size: 1.4rem;
  }
}

/*  */
.card{
            box-shadow: 0px 0px 16px rgba(0, 113, 220, 0.15) !important;
        }
    </style>
@endpush
@section('content')
<div class="cart-item"style="margin-top: 225px;">
  <div class="container">
    <div class="row">
        <div class="col-lg-8">
          <div class="card">
          <div class="card-body">
            @php
              $shipping_address = \App\Models\ShippingAddress::where('customer_id', Auth::user()->id)->first();
              $billing_address = \App\Models\BillingAddress::where('customer_id', Auth::user()->id)->first();

            @endphp  
            <form action="{{route('store-address')}}" method="POST" id="address-form">
              @csrf
              <fieldset>                              
                <legend>Shipping Address</legend>
                @if($shipping_address)
                  <div class="d-flex">
                    <div class="content">
                      <span><i class="fa fa-phone"></i> {{ $shipping_address ? $shipping_address->phone : '' }}</span><br>
                      <span>Contact person name: {{ $shipping_address ? $shipping_address->contact_person_name : '' }}</span><br>
                      <span>Address: {{ $shipping_address ? $shipping_address->address : '' }}, {{ $shipping_address ? $shipping_address->city : '' }}, {{ $shipping_address ? $shipping_address->zip : '' }}</span>
                    </div>
                    <div class="content">
                      <a href="{{route('address')}}" title="Edit address" class="mt-2"><i class="fa fa-edit fa-lg"></i></a>
                    </div>
                  </div>
                @else
                <p class="input-wrapper lg-half">
                  <label for="billing-street-address">Contact person name</label>
                  <input type="text" class="form-text-input" name="contact_person_name" value="{{ $shipping_address ? $shipping_address->contact_person_name : '' }}">  
                </p>
                <p class="input-wrapper lg-half">
                  <label for="shipping-street-address">Phone</label>
                  <input type="text" class="form-text-input" name="phone" value="{{ $shipping_address ? $shipping_address->phone : '' }}" required>
                </p>
                <p class="input-wrapper lg-half">
                  <label for="shipping-street-address">Street Address</label>
                  <input type="text" class="form-text-input" name="address" value="{{ $shipping_address ? $shipping_address->address : '' }}" required> 
                </p>
                <p class="input-wrapper lg-half">
                  <label for="shipping-city">City</label>
                  <input type="text" class="form-text-input" name="city" value="{{ $shipping_address ? $shipping_address->city : '' }}" required>  
                </p>
                <p class="input-wrapper lg-half">
                  <label for="shipping-postal-code">Zip/Postal Code</label>
                  <input type="text" class="form-text-input" name="zip" value="{{ $shipping_address ? $shipping_address->zip : '' }}" required> 
                </p>
                <p class="input-wrapper lg-half">
                  <label for="shipping-postal-code">State</label>
                  <input type="text" class="form-text-input" name="state" value="{{ $shipping_address ? $shipping_address->state : '' }}" required> 
                </p>
                <p class="input-wrapper lg-half">
                  <label for="shipping-country">Country</label>
                  <input type="text" class="form-text-input" list="shipping-country-list" name="country" value="{{ $shipping_address ? $shipping_address->country : '' }}" required>
                  <datalist id="shipping-country-list">
                    <option value="India">
                  </datalist>
                  
                </p>
                @endif
              </fieldset>
              <input type="checkbox" name="same_address" id="same-address" {{ $shipping_address && $shipping_address->is_billing ? 'checked' : '' }}>
              <label for="same-address">Billing Address is the Same as Shipping</label>
              <fieldset>
                <legend>Billing Address</legend>
                @if($billing_address)
                  <div class="d-flex">
                    <div class="content">
                      <span><i class="fa fa-phone"></i> {{ $billing_address ? $billing_address->phone : '' }}</span><br>
                      <span>Contact person name: {{ $billing_address ? $billing_address->contact_person_name : '' }}</span><br>
                      <span>Address: {{ $billing_address ? $billing_address->address : '' }}, {{ $billing_address ? $billing_address->city : '' }}, {{ $billing_address ? $billing_address->zip : '' }}</span>
                    </div>
                    <div class="content">
                      <a href="{{route('address')}}" title="Edit address" class="mt-2"><i class="fa fa-edit fa-lg"></i></a>
                    </div>
                  </div>
                @else
                <p class="input-wrapper lg-half">
                  <label for="billing-street-address">Contact person name</label>
                  <input type="text" class="form-text-input" name="b_contact_person_name" value="{{ $billing_address ? $billing_address->contact_person_name : '' }}">  
                </p>
                <p class="input-wrapper lg-half">
                  <label for="billing-street-address">Phone</label>
                  <input type="text" class="form-text-input" name="b_phone" value="{{ $billing_address ? $billing_address->phone : '' }}">  
                </p>
                <p class="input-wrapper lg-half">
                  <label for="billing-street-address">Street Address</label>
                  <input type="text" class="form-text-input" name="b_address" value="{{ $billing_address ? $billing_address->address : '' }}">
                </p>
                <p class="input-wrapper lg-half">
                  <label for="billing-city">City</label>
                  <input type="text" class="form-text-input" name="b_city" value="{{ $billing_address ? $billing_address->city : '' }}">  
                </p>
                <p class="input-wrapper lg-half">
                  <label for="billing-postal-code">Zip/Postal Code</label>
                  <input type="text" class="form-text-input" name="b_zip" value="{{ $billing_address ? $billing_address->zip : '' }}">
                </p>
                <p class="input-wrapper lg-half">
                  <label for="shipping-postal-code">State</label>
                  <input type="text" class="form-text-input" name="b_state" value="{{ $billing_address ? $billing_address->state : '' }}">  
                </p>
                <p class="input-wrapper lg-half">
                  <label for="billing-country">Country</label>
                  <input type="text" class="form-text-input"  list="billing-country-list" name="b_country" value="{{ $billing_address ? $billing_address->country : '' }}">
                  <datalist id="billing-country-list">
                    <option value="India">   
                  </datalist>  
                </p>
                @endif
              </fieldset>
              <p class="submit-wrap"><button type="submit" class="btn">Next: Payment Information &rarr;</button></p>
            </form>
          </div>
          </div>  
           
        </div>
        @php 
           $total = 0;
           $sub_total = 0;
           $discount = 0;
        @endphp
        @foreach($cart as $id => $details)
            @php 
               $total += ($details['price']-$details['discount']) * $details['quantity'];
               $sub_total += $details['price'] * $details['quantity'];
               $discount+=$details['discount'] * $details['quantity'];
            @endphp
        @endforeach
        <div class="col-lg-4">
             <div class="card">
               <div class="card-body">
                  <div class="d-flex justify-content-between">
                    <span class="cart_title">Sub total</span>
                    <span class="cart_value">
                      <i class="fa fa-rupee"></i>{{ $sub_total }}
                    </span>
                  </div>
                  <div class="d-flex justify-content-between">
                    <span class="cart_title">Discount</span>
                    <span class="cart_value">
                      - <i class="fa fa-rupee"></i>{{ $discount }}
                    </span>
                  </div>
                  <hr>
                  <div class="d-flex justify-content-between">
                    <span class="cart_title">Total</span>
                    <span class="cart_value">
                      <i class="fa fa-rupee"></i>{{ $total }}
                    </span>
                  </div>
               </div>
            </div>
        </div>
    </div>
  </div>
</div>


@endsection
@push('script')
<script>
    // check input for value; float label

var inputs = document.querySelectorAll('form-text-input');
var form = document.getElementById('address-form');

function labelUp(input) {
  var _this = input;
  if (_this.classList.contains('open')) {
    return;
  }
  _this.classList.add('open');
}

function labelDown(input) {
  var _this = input;
  if (_this.classList.contains('open') && !_this.value) {
    _this.classList.remove('open');
  }
}

form.addEventListener('input', function(e) {
  if (e.target.tagName === "INPUT") {
    labelUp(e.target);
  }
}, false);

for (var i = 0, l = inputs.length; i < l; i++) {
  inputs[i].addEventListener('blur', function(e) {
      labelDown(e.target);
  }, false);
}
</script>
@endpush