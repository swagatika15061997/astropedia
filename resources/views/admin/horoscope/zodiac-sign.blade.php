@extends('admin.layouts.app')
@section('title','Zodiac Sign')
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
                       <h4 class="mb-sm-0">Zodiac Sign</h4>

                       <div class="page-title-right">
                           <ol class="breadcrumb m-0">
                               <li class="breadcrumb-item"><a href="{{route('admin_dashboard')}}">Dashboard</a></li>
                               <li class="breadcrumb-item active">Zodiac Sign</li>
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
                                       <h5 class="card-title mb-0">Zodiac sign List</h5>
                                   </div>
                               </div>
                               <div class="col-sm-auto">
                                   <div class="d-flex flex-wrap align-items-start gap-2">
                                       <button class="btn btn-soft-danger" id="remove-actions" onClick="deleteMultiple()"><i class="ri-delete-bin-2-line"></i></button>
                                       <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn" data-bs-target="#showModal"><i class="ri-add-line align-bottom me-1"></i> Add Zodiac Sign</button>
                                   </div>
                               </div>
                           </div>
                       </div>
                       <div class="card-body border-bottom-dashed border-bottom">
                           <form>
                               <div class="row g-3">
                                   <div class="col-xl-6">
                                       <div class="search-box">
                                           <input type="text" class="form-control search" placeholder="Search for zodiac sign...">
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
                                               <th class="sort" data-sort="customer_name">SL No.</th>
                                               <th class="sort" data-sort="email">Name</th>
                                               <th class="sort" data-sort="phone">Image</th>
                                               <th class="sort">Date From</th>
                                               <th class="sort">Date To</th>
                                               <th class="sort" data-sort="status">Status</th>
                                               <th class="sort" data-sort="action">Action</th>
                                           </tr>
                                       </thead>
                                       <tbody class="list form-check-all">
                                         @foreach($zodiac_signs as $key=>$zodiac_sign)
                                           <tr>
                                               <td class="customer_name">{{++$key}}</td>
                                               <td class="customer_name">{{$zodiac_sign->name}}</td>
                                               <td class="email">
                                                 <img src="{{asset('images/horoscope/'.$zodiac_sign->image)}}" class="img-fluid d-block avatar-xxs" alt="">
                                               </td>
                                               <td class="email">{{\Carbon\Carbon::createFromFormat('Y-m-d', $zodiac_sign->date_from)->format('M d')}}</td>
                                               <td class="email">{{\Carbon\Carbon::createFromFormat('Y-m-d', $zodiac_sign->date_to)->format('M d')}}</td>
                                               <td class="status">
                                                    <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                        <input type="checkbox" class="form-check-input status-toggle" id="customSwitchsizelg{{$key}}" data-zodiac-id="{{$zodiac_sign->id}}" {{$zodiac_sign->status == 1?'checked':''}}>
                                                    </div>
                                               </td>
                                               <td>
                                                   <ul class="list-inline hstack gap-2 mb-0">
                                                       <li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Edit">
                                                           <a href=""  class="text-primary d-inline-block edit-item-btn" data-bs-toggle="modal" id="create-btn" data-bs-target="#showModal_{{$zodiac_sign->id}}">
                                                               <i class="ri-pencil-fill fs-16"></i>
                                                           </a>
                                                       </li>
                                                       <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Remove">
                                                           <a class="text-danger d-inline-block remove-item-btn" data-bs-toggle="modal" href="#deleteRecordModal_{{$zodiac_sign->id}}">
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
                                           <p class="text-muted mb-0">We've searched more than 150+ horoscope sign We did not find any horoscope sign for you search.</p>
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
                                       <form class="tablelist-form" method="POST" action="{{route('horoscope.zodiac.store')}}" autocomplete="off" enctype="multipart/form-data">
                                           @csrf
                                            <div class="modal-body">
                                               <input type="hidden" id="id-field" />

                                               <div class="mb-3" id="modal-id" style="display: none;">
                                                   <label for="id-field1" class="form-label">ID</label>
                                                   <input type="text" id="id-field1" class="form-control" placeholder="ID" readonly />
                                               </div>

                                               <div class="mb-3">
                                                   <label for="customername-field" class="form-label">Name</label>
                                                   <input type="text" id="customername-field" class="form-control" name="name" placeholder="Enter horoscope sign name" required />
                                               </div>
                                               <div class="mb-3">
                                                   <label for="customername-field" class="form-label">Image</label>
                                                   <input type="file" id="customername-field" class="form-control" name="image" placeholder="Enter horoscope sign name" required />
                                               </div>
                                               <div class="mb-3">
                                                   <label for="customername-field" class="form-label">Date From</label>
                                                   <input type="date" id="customername-field" class="form-control" name="date_from" required />
                                               </div>
                                               <div class="mb-3">
                                                   <label for="customername-field" class="form-label">Date To</label>
                                                   <input type="date" id="customername-field" class="form-control" name="date_to" required />
                                               </div>
                                           </div>
                                           <div class="modal-footer">
                                               <div class="hstack gap-2 justify-content-end">
                                                   <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                   <button type="submit" class="btn btn-success" id="add-btn">Add Zodiac Sign</button>
                                                   <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                                               </div>
                                           </div>
                                       </form>
                                   </div>
                               </div>
                           </div>

                           <!-- Modal -->
                           @foreach($zodiac_signs as $zodiac_sign)
                           <div class="modal fade" id="showModal_{{$zodiac_sign->id}}" tabindex="-1" aria-hidden="true">
                               <div class="modal-dialog modal-dialog-centered">
                                   <div class="modal-content">
                                       <div class="modal-header bg-light p-3">
                                           <h5 class="modal-title" id="exampleModalLabel"></h5>
                                           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                       </div>
                                       <form class="tablelist-form" method="POST" action="{{ route('horoscope.zodiac.update', $zodiac_sign->id) }}" enctype="multipart/form-data" autocomplete="off">
                                           @csrf
                                            <div class="modal-body">
                                               <input type="hidden" id="id-field" />

                                               <div class="mb-3" id="modal-id" style="display: none;">
                                                   <label for="id-field1" class="form-label">ID</label>
                                                   <input type="text" id="id-field1" class="form-control" placeholder="ID" readonly />
                                               </div>

                                               <div class="mb-3">
                                                   <label for="customername-field" class="form-label">Name</label>
                                                   <input type="text" id="customername-field" class="form-control" name="name" placeholder="Enter horoscope sign name" value="{{$zodiac_sign->name}}" required />
                                               </div>
                                               <div class="mb-3">
                                                   <label for="customername-field" class="form-label">Image</label>
                                                   <input type="file" id="customername-field" class="form-control" name="image" placeholder="Enter horoscope sign name" value="{{$zodiac_sign->image}}" />
                                               </div>
                                               <div class="mb-3">
                                                   <label for="customername-field" class="form-label">Date From</label>
                                                   <input type="date" id="customername-field" class="form-control" name="date_from"  value="{{$zodiac_sign->date_from}}" required />
                                               </div>
                                               <div class="mb-3">
                                                   <label for="customername-field" class="form-label">Date To</label>
                                                   <input type="date" id="customername-field" class="form-control" name="date_to"  value="{{$zodiac_sign->date_from}}" required />
                                               </div>
                                           </div>
                                           <div class="modal-footer">
                                               <div class="hstack gap-2 justify-content-end">
                                                   <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                   <button type="submit" class="btn btn-success" id="add-btn">Update Zodiac Sign</button>
                                                   <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                                               </div>
                                           </div>
                                       </form>
                                   </div>
                               </div>
                           </div>
                           @endforeach
                           @foreach($zodiac_signs as $zodiac_sign)
                           <div class="modal fade zoomIn" id="deleteRecordModal_{{$zodiac_sign->id}}" tabindex="-1" aria-hidden="true">
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
                                               <form action="{{ route('horoscope.zodiac.destroy', $zodiac_sign->id) }}" method="POST">
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
    
    <script>
        $(document).ready(function () {
            $('.status-toggle').change(function () {
                var isChecked = $(this).prop('checked');
                var zodiacId = $(this).data('zodiac-id');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{ route('horoscope.zodiac.status-update') }}",
                    data: {
                        zodiacId: zodiacId,
                        isChecked: isChecked ? 1 : 0,
                    },
                    success: function (response) {
                        if (response['alert-type'] =='success') {
                            // Show success message
                            toastr.options.timeOut = 10000;
                            toastr.success("Status updated successfully");
                            var audio = new Audio('audio.mp3');
                            audio.play();
                            $('#statusMessage').text(response.message).show();
                        } else {
                            toastr.options.timeOut = 10000;
                            toastr.error("{{ Session::get('message') }}");
                            var audio = new Audio('audio.mp3');
                            audio.play();
                        }
                    },
                    error: function () {
                        alert('Failed to update status. Please try again later.');
                    }
                });
            });
        });
    </script>
    
@endpush

