<style>
    .as_cart_1:hover .as_cart_box {
  visibility: visible;
  opacity: 1;
  
}
</style>
@if(Auth::check())
                               @php
                                  $cartItems = [];
                                  $subtotal = 0;
                                  $cartItems = App\Models\Cart::where('customer_id', Auth::user()->id)->get();
                                  foreach ($cartItems as $cartItem) {
                                      $subtotal += $cartItem->quantity * ($cartItem->price-$cartItem->discount);
                                    }
                               @endphp
                               <div class="as_cart_1">
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