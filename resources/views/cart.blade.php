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

thead{
    background: #eee !important;
    border-style: none !important;
}
.quantity{
    margin: 0px !important;
}
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
             <div class="card-header">
               Cart Item
             </div>
             <div class="card-body">
                <table id="cart" class="table table-hover table-condensed">
                    <thead style="border-style: none !important;">
                    <tr>
                        <th>Product</th>
                        <th>Unit Price</th>
                        <th>Quantity</th>
                        <th class="text-center">Price</th>
                        <th style="width:10%"></th>
                    </tr>
                    </thead>
                    <tbody>
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
                            <tr data-id="{{ $details['id'] }}">
                                <td data-th="Product">
                                    <div class="row">
                                        <div class="col-sm-3 hidden-xs"><img src="{{ asset('images/products/thumbnail/'.$details['thumbnail']) }}" width="100" height="100" class="img-responsive"/></div>
                                        <div class="col-sm-9">
                                            <h6 class="nomargin">{{ $details['name'] }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td data-th="Price"><i class="fa fa-rupee"></i>₹{{ $details['price']-$details['discount'] }}</td>
                                <td data-th="Quantity">
                                    <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity update-cart" />
                                </td>
                                <td data-th="Subtotal" class="text-center"><i class="fa fa-rupee"></i>₹{{ ($details['price']-$details['discount']) * $details['quantity'] }}</td>
                                <td class="actions" data-th="">
                                    <button class="btn btn-danger btn-sm remove-cart"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    
                </table>
             </div>
           </div>
    
        </div>
        <div class="col-lg-4">
            <div class="card">
               <div class="card-body">
                    <table>
                      <tr>
                          <td colspan="5" class="text-right"><strong>Sub total</strong></td>
                          <td> <i class="fa fa-rupee"></i>₹{{ $sub_total }}</td>
                      </tr>
                      <tr>
                          <td colspan="5" class="text-right"><strong>Discount</strong></td><td> - <i class="fa fa-rupee"></i>₹{{ $discount }}</td>
                      </tr>
                      <tr>
                          <td colspan="5" class="text-right"><strong>Total</strong></td><td><i class="fa fa-rupee"></i>₹{{ $total }}</td>
                      </tr>
                      <tr>
                          <td colspan="5" class="text-right">
                              <a href="{{ route('shop') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a>
                              <a href="{{ route('checkout') }}"><button class="btn btn-success">Checkout</button></a>
                          </td>
                      </tr>
                    </table>
               </div>
            </div>
        </div>
    </div>
  </div>
</div>


@endsection
@push('script')
<script>
    $(".remove-cart").click(function (e) {
        e.preventDefault();
  
        var ele = $(this);
  
        if(confirm("Are you sure want to remove?")) {
            $.ajax({
                url: '{{ route('remove.cart') }}',
                method: "GET",
                data: {
                    _token: '{{ csrf_token() }}', 
                    id: ele.parents("tr").attr("data-id")
                    
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        }
    });
</script>
@endpush