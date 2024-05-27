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
        .modal.show {
    background-color: rgb(3 29 46 / 1%) !important;
}
.modal-content {
    background-color: #e9ecef !important;
}
.modal .modal-dialog {
  display: block !important;
}
.modal-body {
    margin-top: -51px !important;
}
.modal-body .form-control {
    border: 1px solid #aaa;
    border-radius: 5px;
}
</style>

@endpush
@section('content')
<div class="cart-item" style="margin-top: 225px;">
   <div class="container">
    <div class="row">
        <div class="col-lg-8">
            <h2 class="h6" style="font-weight: 600;">Choose payment</h2>
            <div class="row">
                <div class="col-lg-6 g-8">
                    <div class="card pay">
                       <form action="{{route('order-by-cash')}}" method="get" class="needs-validation">
                            <input type="hidden" name="payment_method" value="cash_on_delivery">
                            <button class="btn btn-block click-if-alone" type="submit">
                               <img src="{{asset('frontend/assets/images/cash-on-delivery.png')}}" alt="" class="img-responsive as_hand_bg" style="width: 120px;height: 50px;">
                            </button>
                        </form>

                    </div>
                </div>
                <div class="col-lg-6 g-8">
                    <div class="card pay">
                      <button type="button" data-toggle="modal" data-target="#wallet_submit_button" data-whatever="@mdo" style="border: none;background-color: unset;">
                         <img src="{{asset('frontend/assets/images/wallet.png')}}" alt="" class="img-responsive as_hand_bg" style="width: 120px;height: 50px;">
                      </button>
                    </div>
                </div>
                <div class="col-lg-12 g-8">
                    <div class="card pay">
                       <img src="{{asset('frontend/assets/images/razor.png')}}" alt="" class="img-responsive as_hand_bg" style="width: 120px;height: 50px;">

                    </div>
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
<div class="modal fade" id="wallet_submit_button" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Wallet Payment</h5>
        <button type="button" class="close" data-dismiss="modal">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('order-by-wallet')}}" method="get">
            @csrf
            @php($customer_balance = Auth::user()->wallet_balance)
            @php($remain_balance = $customer_balance - $total)
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Your current balance</label>
            <input type="text" class="form-control" id="recipient-name" name="contact_person_name" value="{{$customer_balance}}" readonly>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Order amount</label>
            <input type="text" class="form-control" id="recipient-name" name="phone" value="{{$total}}" readonly>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Remaining balance</label>
            <input type="text" class="form-control" id="recipient-name" name="city" value="{{$remain_balance}}" readonly>
            @if($remain_balance < 0)
            <label for="recipient-name" class="col-form-label">You do not have sufficient balance for pay this order!!</label>
            @endif
          </div>  
          <div class="modal-footer">
             <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
             <button type="submit" class="btn btn-primary" {{$remain_balance>0? '':'disabled'}}>Save</button>
          </div>
        </form>
      </div>
      
    </div>
  </div>
</div>


@endsection
@push('script')
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

@endpush