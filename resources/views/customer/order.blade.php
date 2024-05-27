@extends('layouts.frontend.app')

@section('title','Order')

@push('css_or_js')
<link rel="stylesheet" href="{{asset('frontend/assets/css/table.css')}}">
@endpush
@section('content')
<section class="as_padderTop80 as_padderBottom80 page_margin" style="margin-top: 133px;">
    <div class="container">
        <h3 style="text-align: center;color:#000">My Order</h3>
        <div class="row">
           @include('layouts.frontend.partial.side-bar')
           <div class="col-lg-9">
             <table class="responsive-table">
		       <!-- Responsive Table Header Section -->
		        <thead class="responsive-table__head">
		        	<tr class="responsive-table__row">
		        		<th class="responsive-table__head__title responsive-table__head__title--name">Order ID
		        		</th>
		        		<th class="responsive-table__head__title responsive-table__head__title--types">Order Date</th>
		        		<th class="responsive-table__head__title responsive-table__head__title--status">Status</th>
		        		<th class="responsive-table__head__title responsive-table__head__title--update">Total</th>
		        		<th class="responsive-table__head__title responsive-table__head__title--country">Action</th>
		        	</tr>
		        </thead>
		        <!-- Responsive Table Body Section -->
		        <tbody class="responsive-table__body">
                   @foreach($orders as $order)
		        	<tr class="responsive-table__row">
		        		<td class="responsive-table__body__text responsive-table__body__text--name">
		        			{{$order->id}}
		        		</td>
                        <td class="responsive-table__body__text responsive-table__body__text--update">{{$order->created_at}}</td>
		        		<td class="responsive-table__body__text responsive-table__body__text--status">{{$order->order_status}}</td>
		        		<td class="responsive-table__body__text responsive-table__body__text--types">₹{{$order->order_amount}}</td>
		        		<td class="responsive-table__body__text responsive-table__body__text--country">
                            <div class="__btn-grp-sm flex-nowrap">
                                <a href="{{route('order-details',$order->id)}}"
                                class="btn btn--primary __action-btn" title="View">
                                    <i class="fa fa-eye"></i>
                                </a>
                                @if($order->payment_method =='cash_on_delivery' && $order->order_status =='pending')
                                    <a href="javascript:" title="Cancel"
                                    onclick="route_alert('','want_to_cancel_this_order?')"
                                    class="btn btn-danger __action-btn">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                @else
                                    <button class="btn btn-danger __action-btn" title="Cancel" onclick="cancel_message()">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                @endif
                           </div>
                        </td>
		        	</tr>
                   @endforeach
		        	
		        </tbody>
	        </table>
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