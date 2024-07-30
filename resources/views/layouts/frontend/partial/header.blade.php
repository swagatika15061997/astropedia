<style>
.navbar {
  overflow: hidden;
  background-color: #333;
}

.navbar a {
  float: left;
  font-size: 16px;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}
/* .dropbtn {
    display: inline-block; 
    vertical-align: middle; 
}
.dropdown {
  float: left;
  position: relative; 
}

.dropdown .dropbtn {
  font-size: 14px;  
  border: none;
  outline: none;
  color: white;
  background-color: inherit;
  font-family: inherit;
  margin: 0;
}



.dropdown-content {
  display: none;
  position: absolute;
  background-color: #030510bf;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content li {
  color: #fff;
  padding: 2px 16px;
  text-decoration: none;
  display: block;
  font-size: 13px;
  text-align: left;
}

.dropdown-content a:hover {
  color: #fed500;
}


.dropbtn i {
    display: inline-block; 
    vertical-align: middle; 
} */
.dropdown:hover .dropdown-content {
  display: block; 
  color: #fff;
  background: var(--dark-color2);
}
.dropdown-item:hover{
  color: #ffd600;
  background: var(--dark-color2);  
}
.ml-3, .mx-3 {
    margin-inline-start: 1rem !important;
    margin-left: 1rem !important;
}
.navbar-tool {
    position: relative;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-align: center;
    align-items: center;
}
.navbar-tool-icon-box {
    position: relative;
    width: 2.875rem;
    height: 2.875rem;
    transition: color 0.25s ease-in-out;
    border-radius: 50%;
    line-height: 2.625rem;
    text-align: center;
}
.__inline-14 {
    aspect-ratio: 1;
    object-fit: cover;
    object-position: center center;
}

.rounded-circle {
    border-radius: 50% !important;
}
.dropdown .navbar-tool-text::after {
    display: inline-block;
    margin-left: .23375em;
    vertical-align: .23375em;
    content: "";
    border-top: .275em solid;
    border-right: .275em solid transparent;
    border-bottom: 0;
    border-left: .275em solid transparent;
}
.navbar-tool-text > small {
    display: block;
    margin-bottom: -.125rem;
}
.dropdown-divider {
    border-top: 1px dotted #797979;
}
.navbar-tool-text {
    color: #fff;
}
.notifications {
    margin-left: 14px;
}
.notifications .icon_wrap {
    font-size: 28px;
}
.notifications{
  position: relative;
}
.notification_dd{
  position: absolute;
  top: 48px;
  right: -15px;
  user-select: none;
  background: #fff;
  border: 1px solid #c7d8e2;
  width: 350px;
  height: auto;
  display: none;
  border-radius: 3px;
  box-shadow: 10px 10px 35px rgba(0,0,0,0.125),
              -10px -10px 35px rgba(0,0,0,0.125);
  z-index: 999;
}
.notification_dd:before{
    content: "";
    position: absolute;
    top: -20px;
    right: 15px;
    border: 10px solid;
    border-color: transparent transparent #fff transparent;
}

.notification_dd li {
    border-bottom: 1px solid #f1f2f4;
    padding: 10px 20px;
    display: flex;
    align-items: center;
}

.notification_dd li .notify_icon{
  display: flex;
}

.notification_dd li .notify_icon .icon{
  display: inline-block;
  /* background: url('https://i.imgur.com/MVJNkqW.png') no-repeat 0 0; */
	width: 40px;
	height: 42px;
}

.notification_dd li.baskin_robbins .notify_icon .icon{
  background-position: 0 -43px;
}

.notification_dd li.mcd .notify_icon .icon{
  background-position: 0 -86px;
}

.notification_dd li.pizzahut .notify_icon .icon{
  background-position: 0 -129px;
}

.notification_dd li.kfc .notify_icon .icon{
  background-position: 0 -178px;
}

.notification_dd li .notify_data{
  margin: 0 15px;
  width: 185px;
}

.notification_dd li .notify_data .title{
  color: #000;
  font-weight: 600;
}

.notification_dd li .notify_data .sub_title{
  font-size: 14px;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  margin-top: 5px;
}

.notification_dd li .notify_status p{
  font-size: 12px;
}

.notification_dd li.success .notify_status p{
  color: #47da89;
}

.notification_dd li.failed .notify_status p{
  color: #fb0001;
}

.notification_dd li.show_all{
  padding: 20px;
  display: flex;
  justify-content: center;
}

.notification_dd li.show_all p{
  font-weight: 700;
  color: #3b80f9;
  cursor: pointer;
}

.notification_dd li.show_all p:hover{
  text-decoration: underline;
}
.notifications.active .icon_wrap{
  color: #3b80f9;
}
.notification_dd.active {
    display: block;
}
</style>
   <section class="as_header_wrapper">
            <div class="as_info_detail">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <ul>
                                <li>
                                    <a href="javascript:;">
                                        <div class="as_infobox">
                                            <span class="as_infoicon">
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="17" height="17" viewBox="0 0 17 17" style="&#10;">
                                                    <image xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAABEAAAARCAMAAAAMs7fIAAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAAkFBMVEUAAAD///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////8AAACWvj/iAAAALnRSTlMAs+Z9A8OHq1DyTbvnW1I94To8yZWCSMyETosK4MVR8Y0V3IYNlLpJ0QVasu2nQJZtCAAAAAFiS0dEAIgFHUgAAAAJcEhZcwAALiMAAC4jAXilP3YAAACASURBVBjTXc7ZEoIwDAXQsKiIooiKG3VBwZX7/59HIFPael+SnpkkJSLPD8hOOAIwtmUC/BEkkZGpSGxk1r3niTW16GTpHEtZVo5kLGtHaMO07btc798x7bkegKPIqWBS5+jC5Sp0KzHkLvRQhvT6SkM9XHy+elBv6xefr/9riFp+ORMcFJRCjQAAAABJRU5ErkJggg==" width="17" height="17"/>
                                                  </svg>
                                            </span>
                                            +91 7019626663
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:;">
                                        <div class="as_infobox">
                                            <span class="as_infoicon">
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="18" height="13" viewBox="0 0 18 13">
                                                    <image xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAABIAAAANCAMAAACTkM4rAAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAAllBMVEUAAAD///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////8AAADAm+O6AAAAMHRSTlMAnPKljr/GhqKttZn1jLe+g/bxiLvDfn07z9cuDFuRD7MXFoq9k66LrKSjlo+U852fXjOJAAAAAWJLR0QAiAUdSAAAAAlwSFlzAAAuIwAALiMBeKU/dgAAAIZJREFUCNdNj0kSgkAQBFMccUNFcFfABRX3+v/rHCB0qENFRx4qsqElrxG1wdBRIz5d1KPvyIChCDRi/CMTQk2JpJhZTeYspAjPnmG957O07VVIK9bShq3+yOwSTEqSxRWyWyl7pYfjSTlxuRXozMU5XBWggpvzKriLh7Mqk/OEl97NHz98AaD8G1UEUcOeAAAAAElFTkSuQmCC" width="18" height="13"/>
                                                  </svg>
                                                  
                                            </span>
                                            support@aicopl.com
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-6">
                            <div class="as_right_info">
                                <div class="as_search_wrapper" style="width:55%">
                                        <input type="text" name="" class="form-control" id="" placeholder="Search...">
                                        <a href="#">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="15" height="15" viewBox="0 0 15 15">
                                                <image xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAAA8AAAAPCAMAAAAMCGV4AAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAAtFBMVEUAAAD///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////8AAADolZgzAAAAOnRSTlMAXdn8970vurJeTXPTdLwqZWdUIn4O6rmFUtE8ot9q0sLE4wRbI7/OcIMXvnVf+rPVcW18wLBrbmiCc40geAAAAAFiS0dEAIgFHUgAAAAJcEhZcwAALiMAAC4jAXilP3YAAACDSURBVAjXVYvXEoJAEAQHcwIxYFYEA0bMaf7/w7zl4KrYh+nqqVkAsApFlsoVpFdlrd5otmhrddhO6LIj6LKX7vr0VA6G2R84khgbdybiU+OzufjCuL9UEYSZrrhWuTGDbZRgx73gcORJ92fGweVK/8a7LrzHM3pZwJsf5O7LX76w4z/cdAviAFLW+gAAAABJRU5ErkJggg==" width="15" height="15"/>
                                              </svg>
                                              
                                              
                                        </a>
                                </div>
                                @if(Auth::check())
                                
                                <div class="notifications">
                                  <div class="icon_wrap">
                                    <i class="fas fa-comment-alt" style="color: #fed500;"></i>
                                  </div>
                        <div id="notification-container">

                                  @include('layouts.frontend.partial.chat-request')
</div>  
                                </div>
                                @endif
                                @if(Auth::check())
                                <div class="dropdown">
                                     <a class="navbar-tool ml-3 dropbtn" type="button" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                         <div class="navbar-tool-icon-box bg-secondary">
                                             <div class="navbar-tool-icon-box bg-secondary">
                                                 <img  onerror="this.src='{{asset('backend/assets/images/demo/def.jpg')}}'" src="{{asset('images/profile/'.Auth::user()->image)}}"
                                                      class="img-profile rounded-circle __inline-14">
                                             </div>
                                         </div>
                                         <div class="navbar-tool-text">
                                             <small>Hello, {{ Auth::user()->name }}</small>
                                             Dashboard
                                         </div>
                                     </a>
                                     <div class="dropdown-menu dropdown-content" aria-labelledby="dropdownMenuButton">
                                         <a class="dropdown-item"
                                         href="{{route('profile.edit')}}">My Profile</a>
                                         <a class="dropdown-item"
                                         href="{{route('order')}}">My Order</a>
                                         <div class="dropdown-divider"></div>
                                         <a class="dropdown-item">
                                             <form method="POST" action="{{ route('logout') }}">
                                                   @csrf
                                                   <button type="submit" style="background: none;color:#fff; border: none; padding: 0; cursor: pointer;">
                                                      {{ __('Log Out') }}
                                                   </button>
                                             </form>
                                         </a>
                                     </div>
                                </div>

                                @else
                                <div class="as_user">
                                    <a href="{{route('login')}}">
                                        <img src="{{asset('frontend/assets/images/profile.jpg')}}" alt="">
                                        <span class="as_add_user">+</span>
                                    </a>
                                    
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container second-header">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
                        <div class="as_logo">
                            <a href="index.html">
                                <img src="{{asset('frontend/assets/images/logo.png')}}" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-6">
                        <div class="as_right_info">
                            <div class="as_menu_wrapper">
                                <span class="as_toggle">
                                    <img src="{{asset('frontend/assets/images/svg/menu.svg')}}" alt="">
                                </span>
                                <div class="as_menu">
                                    <ul>
                                        <li><a href="/" class="{{Request::is('/')?'active':''}}">home</a></li>
                                        <li><a href="{{route('about-us')}}" class="{{Request::is('about-us')?'active':''}}">about us</a></li>
                                        <li><a href="{{route('services')}}" class="{{Request::is('services')?'active':''}}">service</a></li>
                                        <!-- <li><a href="javascript:;" class="{{Request::is('services')?'active':''}}">pages</a>
                                            <ul class="as_submenu">
                                                <li><a href="{{route('services')}}">service</a></li>
                                                <li><a href="/">service single</a></li>
                                                <li><a href="appointments.html">appointment</a></li>
                                                <li><a href="pricing.html">pricing plans</a></li>
                                                <li><a href="error.html">404</a></li>
                                            </ul>
                                        </li> -->
                                        <li><a href="{{route('shop')}}" class="{{Request::is('shop')?'active':''}}">shop</a></li>
                                        <li><a href="{{route('blog')}}" class="{{Request::is('blog')?'active':''}}">blog</a></li>
                                        <li><a href="{{route('contact')}}" class="{{Request::is('contact')?'active':''}}">contact</a></li>
                                        
                                    </ul>
                                </div>
                            </div>        
                            <a href="javascript:;" class="as_wishlist"><img src="{{asset('frontend/assets/images/svg/wishlist.svg')}}" alt=""></a>
                            @if(Auth::check())
                               @php
                                  $cartItems = [];
                                  $subtotal = 0;
                                  $cartItems = App\Models\Cart::where('customer_id', Auth::user()->id)->get();
                                  foreach ($cartItems as $cartItem) {
                                      $subtotal += $cartItem->quantity * ($cartItem->price-$cartItem->discount);
                                    }
                               @endphp
                               <div id="auth-cart" class="as_cart">
                                <div class="as_cart_wrapper">
                                    <span><img src="{{asset('frontend/assets/images/svg/cart.svg')}}" alt=""><span class="as_cartnumber">{{ $cartItems->count() }}</span></span>
                                </div>
                                <div class="as_cart_box">
                                    @if($cartItems->count() > 0)
                                    <div class="as_cart_list">
                                        <ul>                                           
                                           @foreach($cartItems as $cartItem)
                                            <li data-id="{{ $cartItem->id }}">
                                                <div class="as_cart_img">
                                                    <img src="{{asset('images/products/thumbnail/'.$cartItem->thumbnail)}}" class="img-responsive">
                                                </div>
                                                <div class="as_cart_info">
                                                    <a href="#">{{ $cartItem->name }}</a>
                                                    <p>{{ $cartItem->quantity }} X {{ $cartItem->price-$cartItem->discount}}</p>
                                                    <a href="javascript:;" class="as_cart_remove remove-cart-item"><i class="fa fa-trash"></i></a>
                                                </div>
                                            </li>
                                           @endforeach    
                                        </ul>
                                    </div>
                                    <div class="as_cart_total">
                                        <p>total<span>{{$subtotal}}</span></p>
                                    </div>
                                    <div class="as_cart_btn">
                                        <button type="button" class="as_btn"><a href="{{route('cart')}}">view cart</a></button>
                                        <button type="button" class="as_btn"><a href="#">checkout</a></button>
                                    </div>
                                    @else
                                    <div style="text-align: center;"><i class="fa fa-shopping-cart" style="color:red"></i> <b style="color:red">Empty cart</b></div>
                                    @endif
                                </div>
                                
                            </div>
                            @else
                            <div class="as_cart">
                                <div class="as_cart_wrapper">
                                    <span><img src="{{asset('frontend/assets/images/svg/cart.svg')}}" alt=""><span class="as_cartnumber">{{ count((array) session('cart')) }}</span></span>
                                </div>
        
                                <div class="as_cart_box">
                                  @if(count((array) session('cart'))> 0)
                                    <div class="as_cart_list">
                                        <ul>
                                        @php $total = 0 @endphp
                                        @if(session('cart'))
                                        @foreach(session('cart') as $id => $details)
                                            @php $total += ($details['price']-$details['discount']) * $details['quantity'] @endphp
                                            <li data-id="{{ $id }}">
                                                <div class="as_cart_img">
                                                    <img src="{{asset('images/products/thumbnail/'.$details['thumbnail'])}}" class="img-responsive">
                                                </div>
                                                <div class="as_cart_info">
                                                    <a href="#">{{ $details['name'] }}</a>
                                                    <p>1 X {{ $details['price']-$details['discount'] }}</p>
                                                    <a href="javascript:;" class="as_cart_remove remove-from-cart"><i class="fa fa-trash"></i></a>
                                                </div>
                                            </li>
                                        @endforeach
                                        @endif
                                            
                                        </ul>
                                    </div>
                                    <div class="as_cart_total">
                                        <p>total<span>{{$total}}</span></p>
                                    </div>
                                    <div class="as_cart_btn">
                                        <button type="button" class="as_btn"><a href="{{route('cart')}}">view cart</a></button>
                                        <button type="button" class="as_btn">checkout</button>
                                    </div>
                                  @else
                                    <div style="text-align: center;"><i class="fa fa-shopping-cart" style="color:red"></i> <b style="color:red">Empty cart</b></div>
                                  @endif
                                </div>
                            </div>
                            @endif
                            <!-- <div id="auth-cart">
                            @include('layouts.frontend.partial.cart')
                                </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
        <script>


$(".notifications .icon_wrap").click(function() {
    $(".notification_dd").toggleClass("active");

});



        </script>