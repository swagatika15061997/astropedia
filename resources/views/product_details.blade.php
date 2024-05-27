@extends('layouts.frontend.app')
@section('title','Product Details')
@push('css_or_js')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush
@section('content')
<section class="as_breadcrum_wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h1>Product Details</h1> 

                        <ul class="breadcrumb"> 
                            <li><a href="#">Home</a></li>
                            <li>Product Details</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section class="as_shopsingle_wrapper as_padderBottom80 as_padderTop80">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="as_shopsingle_slider">
                            <div class="as_shopsingle_nav">
                                <div class="as_prod_img" style="width:140px;">
                                    <img src="{{asset('images/products/thumbnail/'.$product->thumbnail)}}" onerror="this.src='{{asset('backend/assets/images/demo/def.jpg')}}'" alt="" class="img-responsive" style="width:140px;">
                                </div>
                                @php
                                   $images=json_decode($product->images);
                                @endphp
                                @foreach ($images as $image)
                                <div class="as_prod_img">
                                    <img src="{{asset('images/products/'.$image)}}" onerror="this.src='{{asset('backend/assets/images/demo/def.jpg')}}'" alt="" class="img-responsive" style="width:140px;">
                                </div>
                                @endforeach
                                
                            </div>
                            <div class="as_shopsingle_for">
                                <div class="as_prod_img">
                                    <img src="{{asset('images/products/thumbnail/'.$product->thumbnail)}}" onerror="this.src='{{asset('backend/assets/images/demo/def.jpg')}}'" alt="" class="img-responsive">
                                </div>
                                
                                @foreach ($images as $image)
                                <div class="as_prod_img">
                                    <img src="{{asset('images/products/'.$image)}}" onerror="this.src='{{asset('backend/assets/images/demo/def.jpg')}}'" alt="" class="img-responsive">
                                </div>
                                @endforeach
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="as_product_description">
                            <h3 class="as_subheading as_margin0 as_padderBottom10">{{$product->name}}</h3>
                            @php
                                $price = 0; // Initialize $price variable
                                if ($product->discount_type == 'flat') {
                                    $price = $product->unit_price - $product->discount;
                                } elseif ($product->discount_type == 'percent') {
                                    $dis = ($product->unit_price * $product->discount) / 100;
                                    $price = $product->unit_price - $dis;
                                }
                            @endphp
                            <h2 class="as_price">
                                &#8377;{{$price}} 
                                @if($product->discount > 0)
                                    <del>&#8377;{{$product->unit_price}}</del> 
                                @endif 
                                @if($product->discount > 0)
                                <span class="as_off as_btn">
                                   @if($product->discount_type=='percent')
                                        {{$product->discount}}% off
                                    @else
                                        &#8377;{{$product->discount}} off
                                    @endif
                                </span>
                                @endif
                            </h2> 
                            <div class="product_rating as_padderBottom10">
                                <span class="rating_star">
                                    <img src="{{asset('frontend/assets/images/rating.png')}}" alt="">
                                    <span>(20 customer review)</span>
                                </span>
                            </div>
                            <p class="as_padderBottom10">
                               {{$product->description}}
                            </p>
                            <div class="prod_detail">
                                
                                <a href="{{ route('addToCart', $product->id) }}" class="add-to-cart" data-product-id="{{ $product->id }}" data-price="{{ $price }}" data-discount="{{ $dis }}"><button type="button" class="buy_btn as_btn" value="Buy Now"><span><img src="{{asset('frontend/assets/images/svg/cart.svg')}}" alt=""></span> add to cart</button></a>

                                <a href="#" class="ad_wishlist">
                                   <img src="{{asset('frontend/assets/images/svg/wishlist1.svg')}}" alt="">
                                </a>
                                <a href="#" class="ad_compare">
                                    <img src="{{asset('frontend/assets/images/svg/compare1.svg')}}" alt="">
                                </a>
                            </div>
                            <div class="as_share_box as_padderTop30"> 
                                <ul>
                                    <li><a href="javascript:;"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="13px" height="24px"> <path fill-rule="evenodd" d="M8.439,24.000 L8.439,13.053 L12.271,13.053 L12.845,8.786 L8.439,8.786 L8.439,6.062 C8.439,4.827 8.795,3.985 10.645,3.985 L13.000,3.984 L13.000,0.167 C12.593,0.116 11.195,0.000 9.567,0.000 C6.169,0.000 3.843,1.988 3.843,5.639 L3.843,8.786 L-0.000,8.786 L-0.000,13.053 L3.843,13.053 L3.843,24.000 L8.439,24.000 Z"/> </svg></a></li>
                                    <li><a href="javascript:;"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="20px"> <path fill-rule="evenodd" d="M24.000,2.368 C23.108,2.769 22.157,3.035 21.165,3.165 C22.185,2.540 22.964,1.558 23.330,0.375 C22.379,0.957 21.329,1.368 20.210,1.597 C19.307,0.611 18.020,-0.000 16.616,-0.000 C13.891,-0.000 11.698,2.268 11.698,5.048 C11.698,5.448 11.731,5.832 11.812,6.198 C7.722,5.994 4.102,3.983 1.671,0.920 C1.246,1.675 0.997,2.540 0.997,3.471 C0.997,5.218 1.875,6.768 3.183,7.665 C2.392,7.649 1.617,7.414 0.960,7.043 C0.960,7.058 0.960,7.078 0.960,7.098 C0.960,9.551 2.665,11.588 4.902,12.057 C4.501,12.169 4.065,12.223 3.612,12.223 C3.297,12.223 2.979,12.205 2.680,12.137 C3.318,14.135 5.127,15.605 7.278,15.652 C5.604,16.995 3.478,17.805 1.177,17.805 C0.774,17.805 0.387,17.786 -0.000,17.735 C2.179,19.177 4.762,20.000 7.548,20.000 C16.602,20.000 21.552,12.308 21.552,5.640 C21.552,5.417 21.545,5.202 21.534,4.988 C22.511,4.277 23.331,3.389 24.000,2.368 Z"/> </svg></a></li>
                                    <li><a href="javascript:;"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="22px" height="22px"> <path fill-rule="evenodd" d="M21.995,21.999 L21.995,22.000 L17.443,22.000 L17.443,14.849 C17.443,13.145 17.408,10.960 15.072,10.960 C12.700,10.960 12.337,12.811 12.337,14.726 L12.337,21.999 L7.782,21.999 L7.782,7.311 L12.157,7.311 L12.157,9.314 L12.221,9.314 C12.829,8.160 14.317,6.943 16.536,6.943 C21.150,6.943 22.000,9.983 22.000,13.931 L22.000,21.999 L21.995,21.999 ZM2.642,5.308 C1.183,5.308 -0.000,4.100 -0.000,2.642 C-0.000,1.183 1.183,-0.000 2.642,-0.000 C4.099,-0.000 5.283,1.183 5.284,2.642 C5.284,4.100 4.100,5.308 2.642,5.308 ZM4.924,22.000 L0.363,22.000 L0.363,7.312 L4.924,7.312 L4.924,22.000 Z"/> </svg></a></li>
                                </ul> 
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-12 col-md-12">
                        <div class="as_tab_wrapper as_padderTop80">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="Today" data-bs-toggle="tab" data-bs-target="#today" type="button" role="tab" aria-controls="today" aria-selected="true">Descriptions</button>
                                  </li>
                                  <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="Tomorrow" data-bs-toggle="tab" data-bs-target="#tomorrow" type="button" role="tab" aria-controls="tomorrow" aria-selected="false">Review</button>
                                  </li>
                            </ul>
                              
                            <div class="tab-content as_padderTop60" id="myTabContent">
                                <div class="tab-pane fade show active" id="today" role="tabpanel" aria-labelledby="Today"> 
                                   {{$product->description}}
                                </div>
                                

                                <div class="tab-pane fade" id="tomorrow" role="tabpanel" aria-labelledby="Tomorrow"> 
                                   <h3 class="as_subheading as_orange as_margin0 as_padderBottom10">Review</h3>
                                   <p class="as_font14 as_padderBottom20">There are no review yet</p>

                                   <h3 class="as_subheading as_orange">Add A Review</h3>
                                   <p class="as_font14 as_padderBottom20">Your email address will not be published.</p>

                                   <form action="#">
                                       <div class="form-group">
                                           <textarea name="" id="" placeholder="Your Review" class="form-control"></textarea>
                                       </div>

                                       <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <input type="text" name="" class="form-control" placeholder="Your Name" class="form-control" id="">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <input type="text" name="" class="form-control" placeholder="Your Email" class="form-control" id="">
                                                </div>
                                            </div>
                                       </div>

                                       <button class="as_btn">submit</button>
                                   </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
       
        <section class="as_product_wrapper as_padderBottom80 as_padderTop80">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 text-center">
                        <h1 class="as_heading">Popular Products </h1>
                        <span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="240" height="15" viewBox="0 0 240 15">
                            <image id="Vector_Smart_Object" data-name="Vector Smart Object" width="240" height="15" xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAAPAAAAAPCAYAAADakUJeAAAJFUlEQVRoge2bC5CVZRnHf4suqCiXhYo1kbsBuparkZmSE0laZIVjlkZaaVmm2W1yxm5azeQMFmpOY9rFUCpNTLAyqEbUQh0uCSKgglxMzHB18YZJ+zTP8/3P2W/P+c6eC4eSOO/Mmf3e+/X/PP/ned9tev6mSRQFK07Kh1rystJ3Ks2qb6t8/LXAO4A3AUdgjARa9Ouj+tuAF4BNGJuAh4AHMe4DNlfUVzXjqkOe7YI265Q3HHgLxmHARODg+Bn9gQEq2wV06LcBYznwN+DPwFNV73ElZep9VuuZntHWng7gJuB9wHlYAPVJ4DngeSz+PgX8Q4B9EdgfGAKMEMBHAKMxxgJPAH8Efo9xO0T54r53HYAP0NgrAXBm2V0M4P2AaRgnAe8EDgQexVgPbAyA+l/j6Vh/L28B6tdBCNcDsFh/H/uwALVxNXBbvpcGgKtvoOYB/W8B3IRxPvARYKDie4em7QawH6J+0g5DsADz3cBdwJ8wVqXadq3RBrQDkzCOkqa4AVggTVLJuKoFhguTbwMfwIIdrAHWYiyMfnsCeCpwAsYbgPHScrdifBUCNLsCwM5cpmqdndkswbgfWAasDDbTXfZQYArGZOC4AK2xFVgNvBzCsxvAvp47sKjdqXW+SvHS4yo3j0rrVJNWqmwt6Rl19kQAtwlUTn8vDzD6AUnyW4I+w2SMaRD0bhFwJ8Y/lTcFOARjLXAzMBvj4Yy+Rgo0EzAeAOYGBa8fgPsKCK7pz1EfubxTBIILBeBZEj63pNp4I3AtFprRBc+/6ghgFw7Tow8LAC6Qhi0s6+s4AzgVQrA8jMV+OFV+DcbxwNvDTIHbsRCey0Wpva1+2o8vhqBNhMXKkuMqN49K61STVqpsLekZdbIAfDTG54HTquq02gH9dwC8l6R1WjYvDaprfKXXNpK4H6oPA2dgjBHYr49DklBBB8pRGPdA0Lm5JYDgWv6jOrB3Ar8DXuql397GlPs+QcBoBfbRYb85pdVc8FwkAH9XQMixhVNDKMF2jC0SNAt3EsD7Au8GjpdA+3lox+J6fQXu84BjMZaEYHHTw4WrcaZAuQ7jRuAXwSrKjQEuw4KaH5nKbxKr+ndF88iK72xaqfrVp/s6XIFxbzqxj/66TXGWnAOLZXcQmgh+ALHpu1NwreKH9lnZtRNSY2/LH4gk+CZ/HPigvtPBy30TGBeHLdEiV0ubjQLOlR08D0IguGPrEq1nOnQGxUs0xSCBZzZwItBc47rmaHmTxjVI+5ULL4uWHqrvXJisshtS8+0qar2y0Kw5zJbAGKQ5XqU5p8Mwrc0mrdU8rd25Wsu7tbYbtNbjtPZrC9pp0l75nqX3a632NheO0N4/K6a1u51hNxVmSbgiQb1YGD0rd8ZcA/8QOBvCBkyCxQZcIDpymKTjROWVDq8eDdwfY2gqfinGN/TtEv8ejAsVbw7tYdwK/AX4emab3fF9ZXPO0OIuw7gCuAlCS5+OhWPM6e33gBUZ2soF58nA+VjYhr+R9nSqvr3kvIop9Gr97sI4R9pnmyj0Lx280sBur39IFHqAWMi1MhUmSMBVSqH3kZZ1Lf7+sPWT8zIvLwh61jsc+IJo+m0Yc0K7JiD8HBbpCyQE3CZ/qcz8LwXepj3wsq8odxYW6W9W/BJMe5mErQU2d/k1rkdaqTbLp68So3lQgulKnZdc2AFcl6PQ+4VLP6FWZ2IB3KMhFv+twE/yC7V7ALgvxpdEWzvjsFh4OpHGuBGLRXki1YabDZ8OmpvVZna8VfTaJeJgaZBr5EltE1UcKKfSHQVUPteOe7A/GeueeFpdO/9BdvrqkmNIvg+RwOnCQrs9DvwUC7B+DfiOAHwx8K0AtfEx4CAIgebOOwfEI2XmPEH25bsCvO7oszAlfiRPcmG9PirrTrNOmRYr5Qx0jfsZ2bHXiyZv6WWOhXGn5650vp/KP1BmzRla5yQtEcoDRednlhVSWfGdTStVv3y6K5bPAvNjjQnq3KZ1d2HvV5cvZtnArfLQXpzZxe7vxPJwkjTIAlEV9xyf7hIttEL5+lkHrV3U5r1YaKPLRRc9f3ykJ2u7TBT68YJ29pJmO0VCZpS8sEvl0fb75s26b+6Qpm4RiA/HQliNDyZlYV/+ON980sfZYQ5ZSO41OtQrZK92yI5u0f3s8GBeCTtwrT4U4zGB4xYxhUK78iCBu1129fzoJ8k7WNT6ZCzSfyaGUosPwDXRJ4A58mg/Jyb0ayx8C6XrV7uv9Ugr1Wb16TPjTFlK2DXugcMRNEWH/l5pimIaWC7es2wzFgA8Tdczfr3xqPIcJNPFDEYEZbf81dRjBW2N1nVUm5jQcJkFg3Wl8ozqPKT71f0FMKdZG3oMrbvNkaK7J+qu1T27E2WDDtbV2TOim5sxVkhzLtF9bXrOo2RPHyfqulFCYW7KDBiLhSnmguFXMT7LU95q1zVtfkyXs3WHHIsLK9qzSsq8egGcmbenA7g+8dJtDRC43Cm4Xgc451BqkbaeJkB1yja/T1rXNW5HyTFaOKfcTJgRQLbQsIsKy1lxPeSRvk5afrak+6pe5tGiF1NHytQ6Vp71OyQE5uevdvzuPBFgY8KJlDxq2VbTOtd7z+pVp5q0UmVrSc+o0wBwPeKVteWg+ZS03Bxp3S7l9VP+VCzub9vFCraKhnfIAdOsG4IxehzSXx7dK3tY1+UBjDy4F2Bcpueh/uhinV6evSJHYIvo71Bpu2XyFrt9vijv3U5s3snhwEvYwTVZwqTqeAPAZfMaAK5HvDqt4tcbF8k56F5Ztyn/Gg6W7rLNYc9a2LfDUu+xOwRat5XHyfZb19t4egFwLj5WTrNH5EB7Qf11qb8n9cBiTcrji7zgx8RdeOJ1X6yru+V1A2EDwGXzGgCuR7y2QzkivM8WzwyHCsQP6IXYlrBDE63n74BfH/Q1ebwxRB7YmfEQo/c+KgEwYgBflif+admUSzH+rvfge8v+btV1or+wOka28g1YeKM3ZvbRAHADwMVp/xcATsfb9cB/kmzbVl0/IS/ret03/xbit73SPioEcO7b73jfo597k0fLS4+ug7bofvJ+LP5xo1ZPcqXjqb1uVrxedapJK1W2lvTCOsB/AGhRDpjYuAlQAAAAAElFTkSuQmCC"/>
                          </svg>
                          </span>
                        <p class="as_font14 as_padderTop20 as_padderBottom10">It is a long established fact that a reader will be distracted by the readable content of a page <br>when looking at its layout. The point of using Lorem Ipsum .</p>
                    

                        <div class="row">
                            @foreach($popular_products as $popular_product)
                            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                <div class="as_product_box">
                                    <div class="as_product_img">
                                        <img src="{{asset('images/products/thumbnail/'.$product->thumbnail)}}" onerror="this.src='{{asset('backend/assets/images/demo/def.jpg')}}'" alt="" class="img-responsive">
                                        @if($product->discount > 0)
                                        <span class="as_new_tag">
                                            @if($product->discount_type=='percent')
                                            {{$product->discount}}% off
                                            @else
                                            &#8377;{{$product->discount}} off
                                            @endif
                                        </span>
                                        @endif
                                        <ul>
                                            <li><a href="#"><img class="as_cart_svg" src="{{asset('frontend/assets/images/svg/cart.svg')}}" alt=""><span>Add To Cart</span></a></li>
                                            <li><a href="#"><img src="{{asset('frontend/assets/images/svg/view.svg')}}" alt=""></a></li>
                                            <li><a href="#"><img src="{{asset('frontend/assets/images/svg/wishlist.svg')}}" alt=""></a></li>
                                            <li><a href="#"><img src="{{asset('frontend/assets/images/svg/compare.svg')}}" alt=""></a></li>
                                        </ul>
                                    </div> 
                                    <div class="as_product_detail">
                                        <span><img src="{{asset('frontend/assets/images/rating.png')}}" alt=""></span>
                                        <h4 class="as_subheading">{{$popular_product->name}}</h4>
                                        @php
                                            $price = 0; // Initialize $price variable
                                            if ($popular_product->discount_type == 'flat') {
                                                $price = $popular_product->unit_price - $popular_product->discount;
                                            } elseif ($popular_product->discount_type == 'percent') {
                                                $dis = ($popular_product->unit_price * $popular_product->discount) / 100;
                                                $price = $popular_product->unit_price - $dis;
                                            }
                                        @endphp
                                        <span class="as_price">&#8377;{{$price}} 
                                                @if($popular_product->discount > 0)
                                                <del>&#8377;{{$popular_product->unit_price}}</del> 
                                                @endif
                                                <span class="as_orange"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </section>
@endsection
@push('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    $(document).ready(function() {
        var previousQuantity = 1; // Initial value

        $('.quantity').on('click', '.plus', function() {
            var input = $(this).siblings('.qty');
            var quantity = parseInt(input.val());
            checkAndUpdateStockLimit(quantity);
        });

        $('.quantity').on('click', '.minus', function() {
            var input = $(this).siblings('.qty');
            var quantity = parseInt(input.val());
            if (quantity < 1) quantity = 1;
            checkAndUpdateStockLimit(quantity);
        });

        $('.quantity').on('change', '.qty', function() {
            var quantity = parseInt($(this).val());
            checkAndUpdateStockLimit(quantity);
        });

        function checkAndUpdateStockLimit(quantity) {
            var productId = "{{ $product->id }}"; // Assuming you're passing the product object from your backend

            $.ajax({
                type: 'POST',
                url: '/check-stock',
                data: {
                    _token: '{{ csrf_token() }}',
                    product_id: productId,
                    quantity: quantity
                },
                success: function(response) {
                    // If stock check is successful, update the input value
                    $('#error-message').hide().empty();
                    $('#quantity_input').val(quantity);
                    previousQuantity = quantity; // Update previous value
                },
                error: function(xhr) {
                    var errors = xhr.responseJSON;
                    if (errors && errors.error) {
                        // Show SweetAlert notification
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: errors.error,
                            onClose: function() {
                                // Reset input value to previous value
                                $('#quantity_input').val(previousQuantity);
                            }
                        });
                    }
                }
            });
        }
    });
</script>
<script>
    $(document).ready(function() {
        $('.add-to-cart-btn').on('click', function(e) {
            e.preventDefault();
            var productId = $(this).data('product-id');
            var price = $(this).data('price');
            var discount = $(this).data('discount');
            
            $.ajax({
                type: 'GET',
                url: '{{ route('addToCart', ':id') }}'.replace(':id', productId),
                data: {
                    _token: '{{ csrf_token() }}',
                    product_id: productId,
                    price: price,
                    discount: discount
                },
                success: function(response) {
                    // Show success message or update UI as needed
                    alert(response.success); // Example: You can use SweetAlert here
                    
                    // Update cart count and content
                    $('#auth-cart').load('{{ route('cart-content') }}');
                },
                error: function(xhr) {
                    var errors = xhr.responseJSON;
                    if (errors && errors.error) {
                        alert(errors.error); // Example: You can use SweetAlert here
                    }
                }
            });
        });
    });
</script>
@endpush