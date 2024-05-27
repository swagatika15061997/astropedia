@extends('admin.layouts.app')

@section('title','Order List')

@push('css_or_js')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- nouisliderribute css -->
    <style>
        .badge-soft-info.fz-12 {
    color: #00c9db;
    background-color: rgba(0, 201, 219, .05);
}
.badge-soft-success {
    color: #00c9a7 !important;
    background-color: rgba(0, 201, 167, .1);
}
    </style>
@endpush
@section('content')
<div class="page-content">
       <div class="container-fluid">
           <!-- start page title -->
           <div class="row">
               <div class="col-12">
                   <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                       <h4 class="mb-sm-0">Order List</h4>

                       <div class="page-title-right">
                           <ol class="breadcrumb m-0">
                               <li class="breadcrumb-item"><a href="{{route('admin_dashboard')}}">Dashboard</a></li>
                               <li class="breadcrumb-item active">Order</li>
                           </ol>
                       </div>

                   </div>
               </div>
           </div>
           <!-- end page title -->

           <div class="row">
               <div class="col-lg-12">
                   <div class="card" id="customerList">
                       <div class="card-header border-bottom-dashed">

                           <div class="row g-4 align-items-center">
                               <div class="col-sm">
                                   <div>
                                       <h5 class="card-title mb-0">Order List</h5>
                                   </div>
                               </div>

                           </div>
                       </div>
                       <div class="card-body border-bottom-dashed border-bottom">
                           <form>
                               <div class="row g-3">
                                   <div class="col-xl-6">
                                       <div class="search-box">
                                           <input type="text" class="form-control search" placeholder="Search for order id">
                                           <i class="ri-search-line search-icon"></i>
                                       </div>
                                   </div>
                                   <!--end col-->
                                   <div class="col-xl-6">
                                       <div class="row g-3">
                                           <div class="col-sm-4">
                                               <div class="">
                                                   <input type="text" class="form-control" id="datepicker-range" data-provider="flatpickr" data-date-format="d M, Y" data-range-date="true" placeholder="Select date">
                                               </div>
                                           </div>
                                           <!--end col-->
                                           <div class="col-sm-4">
                                               <div>
                                                   <select class="form-control" data-plugin="choices" data-choices data-choices-search-false name="choices-single-default" id="idStatus">
                                                       <option value="">Status</option>
                                                       <option value="all" selected>All</option>
                                                       <option value="Active">Active</option>
                                                       <option value="Block">Block</option>
                                                   </select>
                                               </div>
                                           </div>
                                           <!--end col-->

                                           <div class="col-sm-4">
                                               <div>
                                                   <button type="button" class="btn btn-primary w-100" onclick="SearchData();"> <i class="ri-equalizer-fill me-2 align-bottom"></i>Filters</button>
                                               </div>
                                           </div>
                                           <!--end col-->
                                       </div>
                                   </div>
                               </div>
                               <!--end row-->
                           </form>
                       </div>
                       <div class="card-body">
                           <div>
                               <div class="table-responsive table-card mb-1">
                                   <table class="table align-middle" id="customerTable">
                                       <thead class="table-light text-muted">
                                           <tr>
                                               <th class="sort" data-sort="sl_no">SL No.</th>
                                               <th class="sort" data-sort="customer_name">Order Id</th>
                                               <th class="sort" data-sort="email">Date</th>
                                               <th class="sort" data-sort="phone">Customer info</th>
                                               <th class="sort" data-sort="image">Total Amount</th>
                                               <th class="sort" data-sort="status">Order Status</th>
                                               <th class="sort" data-sort="action">Action</th>
                                           </tr>
                                       </thead>
                                       <tbody class="list form-check-all">
                                         @foreach($orders as $key=>$order)
                                           <tr>
                                            <td class="sl_no">
                                                {{++$key}}
                                            </td>
                                               <td class="customer_name">
                                               {{$order['id']}}
                                               </td>
                                               <td class="email">
                                               {{date('d M Y',strtotime($order['created_at']))}}
                                            </td>
                                             <td class="phone">  
                                               @if($order->customer)
                                                <a class="text-body text-capitalize" href="">
                                                    <strong class="title-name">{{$order->customer['name']}}</strong>
                                                </a>
                                                <a class="d-block title-color" href="tel:{{ $order->customer['phone'] }}">{{ $order->customer['phone'] }}</a>
                                              @else
                                              <label class="badge badge-danger fz-12">{{\App\CPU\translate('invalid_customer_data')}}</label>
                                            @endif
                                               </td>
                                               <td>
                                                ₹{{$order['order_amount']}}
                                                @if($order->payment_status=='paid')
                                            <span class="badge text-success fz-12 px-0">
                                                Paid
                                            </span>
                                        @else
                                            <span class="badge text-danger fz-12 px-0">
                                                Unpaid
                                            </span>
                                        @endif
                                               </td>
                                               <td class="status">
                                               @if($order['order_status']=='pending')
                                            <span class="badge badge-soft-info fz-12">
                                                Pending
                                            </span>

                                        @elseif($order['order_status']=='processing' || $order['order_status']=='out_for_delivery')
                                            <span class="badge badge-soft-warning fz-12">
                                                {{str_replace('_',' ',$order['order_status'] == 'processing' ? $order['packaging']:$order['order_status'])}}
                                            </span>
                                        @elseif($order['order_status']=='confirmed')
                                            <span class="badge badge-soft-success fz-12">
                                                Confirmed
                                            </span>
                                        @elseif($order['order_status']=='failed')
                                            <span class="badge badge-danger fz-12">
                                                failed_to_deliver
                                            </span>
                                        @elseif($order['order_status']=='delivered')
                                            <span class="badge badge-soft-success fz-12">
                                                {{$order['order_status']}}
                                            </span>
                                        @else
                                            <span class="badge badge-soft-danger fz-12">
                                                {{$order['order_status']}}
                                            </span>
                                        @endif
                                               </td>
                                               <td>
                                               <a class="btn btn-outline-primary square-btn btn-sm mr-1" title="view"
                                                href="{{route('order.details',['id'=>$order['id']])}}">
                                                <i class="ri-eye-fill"></i>
                                            </a>
                                            <a class="btn btn-outline-success square-btn btn-sm mr-1" target="_blank" title="invoice"
                                                href="{{route('order.generate-invoice',[$order['id']])}}">
                                                <i class="ri-download-2-fill"></i>
                                            </a>
                                               </td>
                                               
                                           </tr>
                                         @endforeach
                                       </tbody>
                                   </table>
                                   <div class="noresult" style="display: none">
                                       <div class="text-center">
                                           <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px"></lord-icon>
                                           <h5 class="mt-2">Sorry! No Result Found</h5>
                                           <p class="text-muted mb-0">We've searched more than 150+ order We did not find any order for you search.</p>
                                       </div>
                                   </div>
                               </div>
                               <div class="d-flex justify-content-end">
                                   <div class="pagination-wrap hstack gap-2">
                                       <a class="page-item pagination-prev disabled" href="#">
                                           Previous
                                       </a>
                                       <ul class="pagination listjs-pagination mb-0"></ul>
                                       <a class="page-item pagination-next" href="#">
                                           Next
                                       </a>
                                   </div>
                               </div>
                           </div>
                           <!-- Modal -->

                           <!--end modal -->
                       </div>
                   </div>

               </div>
               <!--end col-->
           </div>
           <!--end row-->
       </div>
       <!-- container-fluid -->
   </div>        
    
@endsection
@push('script')

@endpush