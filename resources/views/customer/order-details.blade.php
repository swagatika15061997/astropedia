@extends('layouts.frontend.app')

@section('title','Order')

@push('css_or_js')
@vite(['resources/css/app.css', 'resources/js/app.js'])
<style>
    img{
        display:inline !important;
    }
    .py-12{
        padding-top: 0rem !important;
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
.fa-lg{
    padding: 4px;
    
}
.fa-trash{
    color:#fff;
}
.modal-body {
    margin-top: -51px !important;
}
/* Responsive Table Style */
.responsive-table {
  background-color: #fefefe;
  border-collapse: collapse;
  border-radius: 0px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.02);
  width: 100%;
  overflow: hidden;
}
.responsive-table__row {
  display: grid;
  border-bottom: 1px solid #edeef2;
  padding: 0 1.5rem;
}
@media (min-width: 768px) {
  .responsive-table__row {
    grid-template-columns: 2fr 2fr 2fr 2fr 1fr;
  }
}
@media (min-width: 768px) and (max-width: 991px) {
  .responsive-table__row {
    grid-template-columns: 1fr 2fr 1fr;
  }
}
.responsive-table__row th,
.responsive-table__row td {
  padding: 5px;
}
.responsive-table__head {
  background-color: #ffd600;
}
@media (max-width: 991px) {
  .responsive-table__head {
    display: none;
  }
}
.responsive-table__head__title {
  align-items: center;
  font-weight: 600;
  text-transform: capitalize;
  color:#fff;
}
.responsive-table__body .responsive-table__row {
  transition: 0.1s linear;
  transition-property: color, background;
}
.responsive-table__body .responsive-table__row:last-child {
  border-bottom: none;
}
.responsive-table__body .responsive-table__row:hover {
  /* color: #ffffff; */
  /* background-color: #ffd600; */
}
.responsive-table__body__text {
  display: flex;
  flex-wrap: wrap;
  align-items: center;
}
.responsive-table__body__text::before {
  margin-right: 1rem;
  font-weight: 600;
  text-transform: capitalize;
}
@media (max-width: 991px) {
  .responsive-table__body__text::before {
    content: attr(data-title) " :";
  }
}
@media (max-width: 400px) {
  .responsive-table__body__text::before {
    width: 100%;
    margin-bottom: 1rem;
  }
}
.responsive-table__body__text--name {
  font-weight: 600;
}
@media (min-width: 768px) {
  .responsive-table__body__text--name::before {
    display: none;
  }
}
@media (min-width: 768px) and (max-width: 991px) {
  .responsive-table__body__text--name {
    grid-column: 1/2;
    flex-direction: column;
  }
}
@media (min-width: 768px) and (max-width: 991px) {
  .responsive-table__body__text--status, .responsive-table__body__text--types, .responsive-table__body__text--update {
    grid-column: 2/3;
  }
}
@media (min-width: 768px) and (max-width: 991px) {
  .responsive-table__body__text--country {
    grid-column: 3/-1;
  }
}
@media (min-width: 768px) and (max-width: 991px) {
  .responsive-table__body__text--name, .responsive-table__body__text--country {
    grid-row: 2;
  }
}

/* SVG Up Arrow Style */
.up-arrow {
  height: 100%;
  max-height: 1.8rem;
  margin-left: 1rem;
}

/* SVG User Icon Style */
.user-icon {
  width: 100%;
  max-width: 4rem;
  height: auto;
  margin-right: 1rem;
}

/* Status Indicator Style */
.status-indicator {
  display: inline-block;
  width: 1.8rem;
  height: 1.8rem;
  border-radius: 50%;
  background: #222222;
  margin-right: 0.5rem;
}
.status-indicator--active {
  background: #25be64;
}
.status-indicator--inactive {
  background: #dadde4;
}
.status-indicator--new {
  background: #febf02;
}
a.btn.btn--primary.__action-btn {
    background-color: #ffd80b;
    color: #fff;
}
.page-link {
    
    border: none !important;
    
}
</style>
@endpush
@section('content')
<section class="as_padderTop80 as_padderBottom80 page_margin" style="margin-top: 133px;">
    <div class="container">
        <div class="row">
           @include('layouts.frontend.partial.side-bar')
           <div class="col-lg-9">
            <div class="row">
                <div class="col-lg-6">
                   <a class="page-link" href="{{route('order')}}">
                      <i class="fa fa-angle-double-left mr-2"></i>Back
                   </a>
                </div>
            </div>
            <div class="card">
              <div class="card-header">
                  <h4>Order verification code : {{$order->verification_code}}</h4>
              </div>
              <table class="responsive-table">
		            <thead class="responsive-table__head">
		            	<tr class="responsive-table__row">
		            		<th class="responsive-table__head__title responsive-table__head__title--name">
                      <div>Order no:</div><div>{{$order->id}}</div> 
		            		</th>
		            		<th class="responsive-table__head__title responsive-table__head__title--types">
                      <div>Order Date:</div><div>{{date('d M, Y',strtotime($order->created_at))}}</div>
                    </th>
		            		<th class="responsive-table__head__title responsive-table__head__title--status">
                      <div>Shipping Address:</div>
                      @php($shipping=json_decode($order['shipping_address_data']))
                      <div>
                         @if($shipping)
                              {{$shipping->address}},<br>
                              {{$shipping->city}}
                              , {{$shipping->zip}}
                          @endif
                      </div>
                    </th>
		            		<th class="responsive-table__head__title responsive-table__head__title--update">
                      <div>Billing Address:</div>
                        @php($billing=json_decode($order['billing_address_data']))
                        <div>
                           @if($billing)
                                {{$billing->address}},<br>
                                {{$billing->city}}
                                , {{$billing->zip}}
                            @else
                                {{$shipping->address}},<br>
                                {{$shipping->city}}
                                , {{$shipping->zip}}
                            @endif
                        </div>
                    </th>
		            	</tr>
		            </thead>
	            </table>
              <table class="responsive-table">
                 @php($subtotal=0)
                 @php($discount=0)
                 @foreach ($order->details as $key=>$detail)
                 @php($product=json_decode($detail->product_details,true))
                 @if($product)
		         	   <tr class="responsive-table__row">
		         		    <td class="responsive-table__body__text">
                       <img src="{{asset('images/products/thumbnail/'.$product['thumbnail'])}}" onerror="this.src='{{asset('backend/assets/images/demo/def.jpg')}}'" alt="" class="img-responsive" style="width: 50%;">
		         		    </td>
                    <td class="responsive-table__body__text">{{$product['name']}}</td>
                    <td></td>
		         		    <td class="responsive-table__body__text">
                       <div>
                         <span class="font-weight-bold amount">₹{{$detail->price}} </span>
                           <br>
                         <span class="word-nobreak">Qty: {{$detail->qty}}</span>
                       </div>
                     </td>	
		         	   </tr>
                 @endif
                   @php($subtotal+=$detail['price']*$detail->qty)
                   @php($discount+=$detail['discount']*$detail->qty)
                 @endforeach   
	            </table>
            </div>
            <div class="row d-flex justify-content-end">
                <div class="col-md-8 col-lg-5">
                  <table class="table table-borderless">
                    <tbody class="totals">
                      <tr>
                        <td>
                          <div>
                              <span>Item</span>
                          </div>
                        </td>
                        <td>
                          <div>
                              <span>{{$order->details->count()}}</span>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>
                            <div>
                                <span class="product-qty ">
                                    Subtotal
                                </span>
                            </div>
                        </td>
                        <td>
                            <div>            
                                <span>₹{{$subtotal}}</span>
                            </div>
                        </td>
                      </tr>
                      <tr>
                        <td>
                            <div>
                                <span class="product-qty ">Discount</span>
                            </div>
                        </td>
                        <td>
                            <div>
                                <span>- ₹{{$discount}}</span>
                            </div>
                        </td>
                      </tr>
                      <tr class="border-top border-bottom">
                        <td>
                          <div>
                              <span class="font-weight-bold">Total</span>
                          </div>
                        </td>
                        <td>
                          <div>
                            <span class="font-weight-bold amount ">₹{{$order->order_amount}}</span>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  <div class="justify-content mt-4 for-mobile-glaxy __gap-6px flex-nowrap">
                      <a href="{{route('generate-invoice',[$order->id])}}" class="btn btn--primary for-glaxy-mobile w-50" style="width: 100% !important;color:#fff;background-image: -webkit-linear-gradient( 0deg, rgb(244,170,54) 0%, rgb(243,115,53) 100%) !important;border-color: #f38635 !important;">
                        Generate invoice
                      </a>
                  </div>
                </div>
            </div>
           </div>
        </div> 
    </div>
</section>

@endsection
@push('script')
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    const headTitleName = document.querySelector(
	".responsive-table__head__title--name"
);
const headTitleStatus = document.querySelector(
	".responsive-table__head__title--status"
);
const headTitleTypes = document.querySelector(
	".responsive-table__head__title--types"
);
const headTitleUpdate = document.querySelector(
	".responsive-table__head__title--update"
);
const headTitleCountry = document.querySelector(
	".responsive-table__head__title--country"
);

// Select tbody text from Dom
const bodyTextName = document.querySelectorAll(
	".responsive-table__body__text--name"
);
const bodyTextStatus = document.querySelectorAll(
	".responsive-table__body__text--status"
);
const bodyTextTypes = document.querySelectorAll(
	".responsive-table__body__text--types"
);
const bodyTextUpdate = document.querySelectorAll(
	".responsive-table__body__text--update"
);
const bodyTextCountry = document.querySelectorAll(
	".responsive-table__body__text--country"
);

// Select all tbody table row from Dom
const totalTableBodyRow = document.querySelectorAll(
	".responsive-table__body .responsive-table__row"
);

// Get thead titles and append those into tbody table data items as a "data-title" attribute
for (let i = 0; i < totalTableBodyRow.length; i++) {
	bodyTextName[i].setAttribute("data-title", headTitleName.innerText);
	bodyTextStatus[i].setAttribute("data-title", headTitleStatus.innerText);
	bodyTextTypes[i].setAttribute("data-title", headTitleTypes.innerText);
	bodyTextUpdate[i].setAttribute("data-title", headTitleUpdate.innerText);
	bodyTextCountry[i].setAttribute("data-title", headTitleCountry.innerText);
}
</script>
@endpush