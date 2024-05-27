@extends('layouts.frontend.app')

@section('title','Booking')

@push('css_or_js')
<link rel="stylesheet" href="{{asset('frontend/assets/css/table.css')}}">
<style>
    @media (min-width: 768px) {
    .responsive-table__row {
        grid-template-columns: 3fr 3fr 2fr !important;
    }
}
</style>
@endpush
@section('content')
<section class="as_padderTop80 as_padderBottom80 page_margin" style="margin-top: 133px;">
    <div class="container">
        <h3 style="text-align: center;color:#000">Booking</h3>
        <div class="row">
           @include('layouts.frontend.partial.side-bar')
           <div class="col-lg-9">
             <table class="responsive-table">
		       <!-- Responsive Table Header Section -->
		        <thead class="responsive-table__head">
		        	<tr class="responsive-table__row">
		        		<th class="responsive-table__head__title responsive-table__head__title--name">Service Name
		        		</th>
		        		<th class="responsive-table__head__title responsive-table__head__title--types">Astrologer</th>
		        		<th class="responsive-table__head__title responsive-table__head__title--status">Amount</th>

		        	</tr>
		        </thead>
		        <!-- Responsive Table Body Section -->
		        <tbody class="responsive-table__body">
                   @foreach($bookings as $booking)
		        	<tr class="responsive-table__row">
		        		<td class="responsive-table__body__text responsive-table__body__text--name">
		        			{{$booking->service->name}}
		        		</td>
                        <td class="responsive-table__body__text responsive-table__body__text--update">{{$booking->astrologer->name}}</td>
		        		<td class="responsive-table__body__text responsive-table__body__text--status">{{$booking->amount}}</td>
		        		
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