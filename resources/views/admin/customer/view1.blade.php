@extends('admin.layouts.app')
@section('title','Customer')
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
                                <h4 class="mb-sm-0">Customer Details</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                        <li class="breadcrumb-item active">Customer Details</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-xxl-3">
                            <div class="card">
                                <div class="card-body p-4">
                                    <div>
                                        <div class="flex-shrink-0 avatar-md mx-auto">
                                            <div class="avatar-title bg-light rounded">
                                            <img src="{{asset('images/profile/'.$customer->image)}}" onerror="this.src='{{asset('backend/assets/images/demo/def.jpg')}}'" alt="" height="50" />
                                            </div>
                                        </div>
                                        <div class="mt-4 text-center">
                                            <h5 class="mb-1">Force Medicines</h5>
                                            <p class="text-muted">Since 1987</p>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table mb-0 table-borderless">
                                                <tbody>
                                                    <tr>
                                                        <th><span class="fw-medium">Owner Name</span></th>
                                                        <td>David Marshall</td>
                                                    </tr>
                                                    <tr>
                                                        <th><span class="fw-medium">Company Type</span></th>
                                                        <td>Partnership</td>
                                                    </tr>
                                                    <tr>
                                                        <th><span class="fw-medium">Email</span></th>
                                                        <td>forcemedicines@gamil.com</td>
                                                    </tr>
                                                    <tr>
                                                        <th><span class="fw-medium">Website</span></th>
                                                        <td><a href="javascript:void(0);" class="link-primary">www.forcemedicines.com</a></td>
                                                    </tr>
                                                    <tr>
                                                        <th><span class="fw-medium">Contact No.</span></th>
                                                        <td>+(123) 9876 654 321</td>
                                                    </tr>
                                                    <tr>
                                                        <th><span class="fw-medium">Fax</span></th>
                                                        <td>+1 999 876 5432</td>
                                                    </tr>
                                                    <tr>
                                                        <th><span class="fw-medium">Location</span></th>
                                                        <td>United Kingdom</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!--end card-body-->
                                
                                <!--end card-body-->
                                
                               
                                <!--end card-body-->
                            </div>
                            <!--end card-->
                        </div>
                        <!--end col-->

                        <div class="col-xxl-9">
                            <div class="row g-4 mb-3">
                            
                            </div>
                            <div class="card">
                                <div class="card-header">
                                   <h4 class="card-title mb-0 flex-grow-1">Wallet Transaction</h4>
                                </div>
                                
                                <div class="card-body">
                                <div>
                               <div class="table-responsive table-card mb-1">
                                   <table class="table align-middle" id="customerTable">
                                       <thead class="table-light text-muted">
                                           <tr>
                                               <th class="sort">SL No.</th>
                                               <th class="sort" data-sort="customer_name">Transaction Type</th>
                                               <th class="sort" data-sort="email">Amount</th>
                                               <th class="sort" data-sort="phone">Date</th>
                                               <th class="sort" data-sort="image">Message</th>
                                           </tr>
                                       </thead>
                                       <tbody class="list form-check-all">
                                         @foreach($wallets as $key=>$wallet)
                                           <tr>
                                               <td>{{++$key}}</td>
                                               <td class="customer_name">{{$wallet->transaction_type}}</td>
                                               <td class="email">{{$wallet->amount}}</td>
                                               <td class="phone">{{$wallet->created_at}}</td>
                                               <td class="date">{{$wallet->message}}</td>
                                               
                                           </tr>
                                         @endforeach
                                       </tbody>
                                   </table>
                                   <div class="noresult" style="display: none">
                                       <div class="text-center">
                                           <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px"></lord-icon>
                                           <h5 class="mt-2">Sorry! No Result Found</h5>
                                           <p class="text-muted mb-0">We've searched more than 150+ wallet transaction We did not find any wallet transaction for you search.</p>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.status-toggle').change(function () {
                var isChecked = $(this).prop('checked');
                var customerId = $(this).data('customer-id');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{ route('customer.status-update') }}",
                    data: {
                        customerId: customerId,
                        isChecked: isChecked ? 1 : 0,
                    },
                    success: function (response) {
                        if (response.success) {
                            // Show success message
                            $('#statusMessage').text(response.message).show();
                        } else {
                            alert('Failed to update status.');
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

