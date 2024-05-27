@extends('astrologer.layouts.app')
@section('title','Chat Request')
@push('css_or_js')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush
@section('content')
   <div class="page-content">
       <div class="container-fluid">
           <!-- start page title -->
           <div class="row">
               <div class="col-12">
                   <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                       <h4 class="mb-sm-0">Chat Request</h4>

                       <div class="page-title-right">
                           <ol class="breadcrumb m-0">
                               <li class="breadcrumb-item"><a href="{{route('admin_dashboard')}}">Dashboard</a></li>
                               <li class="breadcrumb-item active">Chat Request</li>
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
                                       <h5 class="card-title mb-0">Chat Request</h5>
                                   </div>
                               </div>
                               <div class="col-sm-auto">
                                   <div class="d-flex flex-wrap align-items-start gap-2">
                                       <button class="btn btn-soft-danger" id="remove-actions" onClick="deleteMultiple()"><i class="ri-delete-bin-2-line"></i></button>
                                       <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn" data-bs-target="#showModal"><i class="ri-add-line align-bottom me-1"></i> Add Category</button>
                                   </div>
                               </div>
                           </div>
                       </div>
                       <div class="card-body border-bottom-dashed border-bottom">
                           <form>
                               <div class="row g-3">
                                   <div class="col-xl-6">
                                       <div class="search-box">
                                           <input type="text" class="form-control search" placeholder="Search for category...">
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
                                               <th class="sort" data-sort="">SL No.</th>
                                               <th class="sort" data-sort="customer_name">Customer</th>
                                               <th class="sort" data-sort="status">Status</th>
                                               <th class="sort" data-sort="action">Action</th>
                                           </tr>
                                       </thead>
                                       <tbody class="list form-check-all">
                                         @foreach($chat_requests as $key=>$chat_request)
                                           <tr>
                                               <td class="">{{++$key}}</td>
                                               <td class="customer_name">{{$chat_request->customer->name}}</td>
                                               <td class="status">
                                                @if($chat_request->status=='pending')
                                                <div class="d-grid gap-2 d-md-block">

                                                    <a href="{{route('astrologer.chat.accept-chat-request',$chat_request->id)}}">
                                                        <button type="button" class="btn btn-outline-primary">Accept</button>
                                                    </a>
                                                    <a href="{{route('astrologer.chat.reject-chat-request',$chat_request->id)}}">
                                                        <button type="button" class="btn btn-outline-danger">Reject</button>
                                                    </a>
                                                </div>
                                                @elseif($chat_request->status=='accepted')
                                                <a href="">
                                                    <button type="button" class="btn btn-outline-success">Chat</button>
                                                </a>
                                                @elseif($chat_request->status=='completed')
                                                <span class="badge rounded-pill bg-success-subtle text-success">{{$chat_request->status}}</span>
                                                @elseif($chat_request->status=='rejected')
                                                <span class="badge rounded-pill bg-danger-subtle text-danger">{{$chat_request->status}}</span>
                                                @endif
                                               </td>
                                               <td>
                                                   <ul class="list-inline hstack gap-2 mb-0">
                                                       <li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Edit">
                                                           <a href=""  class="text-primary d-inline-block edit-item-btn" data-bs-toggle="modal" id="create-btn" data-bs-target="#showModal_{{$chat_request->id}}">
                                                               <i class="ri-pencil-fill fs-16"></i>
                                                           </a>
                                                       </li>
                                                       <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Remove">
                                                           <a class="text-danger d-inline-block remove-item-btn" data-bs-toggle="modal" href="#deleteRecordModal_{{$chat_request->id}}">
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
                                           <p class="text-muted mb-0">We've searched more than 150+ category We did not find any category for you search.</p>
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
                           <div class="modal fade" id="showModal" tabindex="-1" aria-hidden="true">
                               <div class="modal-dialog modal-dialog-centered">
                                   <div class="modal-content">
                                       <div class="modal-header bg-light p-3">
                                           <h5 class="modal-title" id="exampleModalLabel"></h5>
                                           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                       </div>
                                       <form class="tablelist-form" method="POST" action="{{route('category.store')}}" autocomplete="off">
                                           @csrf
                                            <div class="modal-body">
                                               <input type="hidden" id="id-field" />

                                               <div class="mb-3" id="modal-id" style="display: none;">
                                                   <label for="id-field1" class="form-label">ID</label>
                                                   <input type="text" id="id-field1" class="form-control" placeholder="ID" readonly />
                                               </div>

                                               <div class="mb-3">
                                                   <label for="customername-field" class="form-label">Category Name</label>
                                                   <input type="text" id="customername-field" class="form-control" name="name" placeholder="Enter name" required />
                                                   <div class="invalid-feedback">Please enter category name.</div>
                                               </div>
                                           </div>
                                           <div class="modal-footer">
                                               <div class="hstack gap-2 justify-content-end">
                                                   <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                   <button type="submit" class="btn btn-success" id="add-btn">Add Category</button>
                                                   <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                                               </div>
                                           </div>
                                       </form>
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

