@extends('admin.layouts.app')

@section('title','Product List')

@push('css_or_js')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- nouisliderribute css -->
@endpush
@section('content')
<div class="page-content">
       <div class="container-fluid">
           <!-- start page title -->
           <div class="row">
               <div class="col-12">
                   <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                       <h4 class="mb-sm-0">Product List</h4>

                       <div class="page-title-right">
                           <ol class="breadcrumb m-0">
                               <li class="breadcrumb-item"><a href="{{route('admin_dashboard')}}">Dashboard</a></li>
                               <li class="breadcrumb-item active">Product</li>
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
                                       <h5 class="card-title mb-0">Product List</h5>
                                   </div>
                               </div>
                               <div class="col-sm-auto">
                                   <div class="d-flex flex-wrap align-items-start gap-2">
                                       <button class="btn btn-soft-danger" id="remove-actions" onClick="deleteMultiple()"><i class="ri-delete-bin-2-line"></i></button>
                                       <a href="{{route('product.create')}}" class="btn btn-success add-btn"><i class="ri-add-line align-bottom me-1"></i> Add Product</a>
                                       <button type="button" class="btn btn-info"><i class="ri-file-download-line align-bottom me-1"></i> Import</button>
                                   </div>
                               </div>
                           </div>
                       </div>
                       <div class="card-body border-bottom-dashed border-bottom">
                           <form>
                               <div class="row g-3">
                                   <div class="col-xl-6">
                                       <div class="search-box">
                                           <input type="text" class="form-control search" placeholder="Search for product name">
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
                                               <th class="sort">SL No.</td>
                                               <th class="sort" data-sort="customer_name">Product Name</th>
                                               <th class="sort" data-sort="email">Price</th>
                                               <th class="sort" data-sort="phone">Stock</th>
                                               <th class="sort" data-sort="image">Discount</th>
                                               <th class="sort" data-sort="action">Action</th>
                                           </tr>
                                       </thead>
                                       <tbody class="list form-check-all">
                                         @foreach($products as $key=>$product)
                                           <tr>
                                               <td>{{++$key}}</td>
                                               <td class="customer_name"><img src="{{asset('images/products/thumbnail/'.$product->thumbnail)}}" onerror="this.src='{{asset('backend/assets/images/demo/def.jpg')}}'" class="rounded-circle img-thumbnail user-profile-image material-shadow" alt="image" style="width: 5rem;">{{$product->name}}</td>
                                               <td class="email">₹{{$product->unit_price}}</td>
                                               <td class="phone">{{$product->current_stock}}</td>
                                               <td class="date">
                                                {{$product->discount}}
                                                 @if($product->discount_type=='percent')
                                                 %@endif
                                               </td>
                                               
                                               <td>
                                                   <ul class="list-inline hstack gap-2 mb-0">
                                                       <li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Edit">
                                                           <a href="{{ route('product.edit', $product->id) }}" class="text-primary d-inline-block edit-item-btn">
                                                               <i class="ri-pencil-fill fs-16"></i>
                                                           </a>
                                                       </li>
                                                       <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Remove">
                                                           <a class="text-danger d-inline-block remove-item-btn" data-bs-toggle="modal" href="#deleteRecordModal_{{$product->id}}">
                                                               <i class="ri-delete-bin-5-fill fs-16"></i>
                                                           </a>
                                                       </li>
                                                   </ul>
                                               </td>
                                           </tr>
                                         @endforeach
                                       </tbody>
                                   </table>
                                   <div class="noresult" style="display: none">
                                       <div class="text-center">
                                           <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px"></lord-icon>
                                           <h5 class="mt-2">Sorry! No Result Found</h5>
                                           <p class="text-muted mb-0">We've searched more than 150+ customer We did not find any customer for you search.</p>
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
                           @foreach($products as $product)
                           <div class="modal fade zoomIn" id="deleteRecordModal_{{$product->id}}" tabindex="-1" aria-hidden="true">
                               <div class="modal-dialog modal-dialog-centered">
                                   <div class="modal-content">
                                       <div class="modal-header">
                                           <button type="button" class="btn-close" id="deleteRecord-close" data-bs-dismiss="modal" aria-label="Close" id="btn-close"></button>
                                       </div>
                                       <div class="modal-body">
                                           <div class="mt-2 text-center">
                                               <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                                               <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                                                   <h4>Are you sure ?</h4>
                                                   <p class="text-muted mx-4 mb-0">Are you sure you want to remove this record ?</p>
                                               </div>
                                           </div>
                                           <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                                               <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                                               <form action="{{ route('product.destroy', $product->id) }}" method="POST">
                                                   @csrf
                                                   @method('DELETE')
                                                   <button type="submit" class="btn w-sm btn-danger" id="delete-record">Yes, Delete It!</button>
                                                </form>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                           </div>
                           @endforeach
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