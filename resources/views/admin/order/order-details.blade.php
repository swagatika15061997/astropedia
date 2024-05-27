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
                                <h4 class="mb-sm-0">Order Details</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Ecommerce</a></li>
                                        <li class="breadcrumb-item active">Order Details</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-xl-9">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex align-items-center">
                                        <h5 class="card-title flex-grow-1 mb-0">Order #{{$order->id}}</h5>
                                        <div class="flex-shrink-0">
                                            <a href="apps-invoices-details.html" class="btn btn-success btn-sm"><i class="ri-download-2-fill align-middle me-1"></i> Invoice</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive table-card">
                                        <table class="table table-nowrap align-middle table-borderless mb-0">
                                            <thead class="table-light text-muted">
                                                <tr>
                                                    <th scope="col">Product Details</th>
                                                    <th scope="col">Item Price</th>
                                                    <th scope="col">Quantity</th>
                                                    <th scope="col">Discount</th>
                                                    <th scope="col" class="text-end">Total Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                             @php($subtotal=0)
                                             @php($total=0)
                                             @php($discount=0)
                                             @php($row=0)
                                             @foreach ($order->details as $key=>$detail)
                                               @php($product=json_decode($detail->product_details,true))
                                               @if($product)
                                                <tr>
                                                    <td>
                                                        <div class="d-flex">
                                                            <div class="flex-shrink-0 avatar-md bg-light rounded p-1">
                                                                <img src="{{asset('images/products/thumbnail/'.$product['thumbnail'])}}" onerror="this.src='{{asset('backend/assets/images/demo/def.jpg')}}'" alt="" class="img-fluid d-block">
                                                            </div>
                                                            <div class="flex-grow-1 ms-3">
                                                                <h5 class="fs-15"><a href="apps-ecommerce-product-details.html" class="link-primary">{{$product['name']}}</a></h5>
                                                                <p class="text-muted mb-0">Color: <span class="fw-medium">Pink</span></p>
                                                                <p class="text-muted mb-0">Size: <span class="fw-medium">M</span></p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>₹{{$detail->price}}</td>
                                                    <td>{{$detail->qty}}</td>
                                                    <td>
                                                      ₹{{$detail->discount}}
                                                    </td>
                                                    <td class="fw-medium text-end">
                                                      @php($subtotal=$detail['price']*$detail->qty-$detail['discount'])
                                                      ₹{{$subtotal}}

                                                    </td>
                                                </tr>
                                                @php($discount+=$detail['discount'])
                                                @php($total+=$subtotal)
                                               @endif
                                             @endforeach
                                               
                                                <tr class="border-top border-top-dashed">
                                                    <td colspan="3"></td>
                                                    <td colspan="2" class="fw-medium p-0">
                                                        <table class="table table-borderless mb-0">
                                                            <tbody>
                                                                
                                                                <tr class="border-top border-top-dashed">
                                                                    <th scope="row">Total :</th>
                                                                    <th class="text-end">₹{{$total}}</th>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!--end card-->
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-sm-flex align-items-center">
                                        <h5 class="card-title flex-grow-1 mb-0">Order Status</h5>
                                        <div class="flex-shrink-0 mt-2 mt-sm-0">
                                            <a href="javascript:void(0);" class="btn btn-soft-info material-shadow-none btn-sm mt-2 mt-sm-0"><i class="ri-map-pin-line align-middle me-1"></i> Change Address</a>
                                            <a href="javascript:void(0);" class="btn btn-soft-danger material-shadow-none btn-sm mt-2 mt-sm-0"><i class="mdi mdi-archive-remove-outline align-middle me-1"></i> Cancel Order</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="profile-timeline">
                                        <div class="accordion accordion-flush" id="accordionFlushExample">
                                            <div class="accordion-item border-0">
                                                <div class="accordion-header" id="headingOne">
                                                    <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-shrink-0 avatar-xs">
                                                                <div class="avatar-title bg-success rounded-circle material-shadow">
                                                                    <i class="ri-shopping-bag-line"></i>
                                                                </div>
                                                            </div>
                                                            <div class="flex-grow-1 ms-3">
                                                                <h6 class="fs-15 mb-0 fw-semibold">Order Placed - <span class="fw-normal">Wed, 15 Dec 2021</span></h6>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body ms-2 ps-5 pt-0">
                                                        <h6 class="mb-1">An order has been placed.</h6>
                                                        <p class="text-muted">Wed, 15 Dec 2021 - 05:34PM</p>

                                                        <h6 class="mb-1">Seller has processed your order.</h6>
                                                        <p class="text-muted mb-0">Thu, 16 Dec 2021 - 5:48AM</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item border-0">
                                                <div class="accordion-header" id="headingTwo">
                                                    <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-shrink-0 avatar-xs">
                                                                <div class="avatar-title bg-success rounded-circle material-shadow">
                                                                    <i class="mdi mdi-gift-outline"></i>
                                                                </div>
                                                            </div>
                                                            <div class="flex-grow-1 ms-3">
                                                                <h6 class="fs-15 mb-1 fw-semibold">Packed - <span class="fw-normal">Thu, 16 Dec 2021</span></h6>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body ms-2 ps-5 pt-0">
                                                        <h6 class="mb-1">Your Item has been picked up by courier partner</h6>
                                                        <p class="text-muted mb-0">Fri, 17 Dec 2021 - 9:45AM</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item border-0">
                                                <div class="accordion-header" id="headingThree">
                                                    <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-shrink-0 avatar-xs">
                                                                <div class="avatar-title bg-success rounded-circle material-shadow">
                                                                    <i class="ri-truck-line"></i>
                                                                </div>
                                                            </div>
                                                            <div class="flex-grow-1 ms-3">
                                                                <h6 class="fs-15 mb-1 fw-semibold">Shipping - <span class="fw-normal">Thu, 16 Dec 2021</span></h6>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div id="collapseThree" class="accordion-collapse collapse show" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body ms-2 ps-5 pt-0">
                                                        <h6 class="fs-14">RQK Logistics - MFDS1400457854</h6>
                                                        <h6 class="mb-1">Your item has been shipped.</h6>
                                                        <p class="text-muted mb-0">Sat, 18 Dec 2021 - 4.54PM</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item border-0">
                                                <div class="accordion-header" id="headingFour">
                                                    <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse" href="#collapseFour" aria-expanded="false">
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-shrink-0 avatar-xs">
                                                                <div class="avatar-title bg-light text-success rounded-circle material-shadow">
                                                                    <i class="ri-takeaway-fill"></i>
                                                                </div>
                                                            </div>
                                                            <div class="flex-grow-1 ms-3">
                                                                <h6 class="fs-14 mb-0 fw-semibold">Out For Delivery</h6>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="accordion-item border-0">
                                                <div class="accordion-header" id="headingFive">
                                                    <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse" href="#collapseFile" aria-expanded="false">
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-shrink-0 avatar-xs">
                                                                <div class="avatar-title bg-light text-success rounded-circle material-shadow">
                                                                    <i class="mdi mdi-package-variant"></i>
                                                                </div>
                                                            </div>
                                                            <div class="flex-grow-1 ms-3">
                                                                <h6 class="fs-14 mb-0 fw-semibold">Delivered</h6>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end accordion-->
                                    </div>
                                </div>
                            </div>
                            <!--end card-->
                        </div>
                        <!--end col-->
                           <div class="col-xl-3">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Order status</h5>
                                    </div>
                                    <div class="card-body">
                                        <label for="choices-publish-status-input" class="form-label">Order Satus</label>
                                        <select class="form-select" name="order_status" onchange="updateOrderStatus('{{ $order->id }}', this.value)">
                                          <option value="pending" {{$order->order_status == 'pending'?'selected':''}} > Pending</option>
                                          <option value="confirmed" {{$order->order_status == 'confirmed'?'selected':''}} > Confirmed</option>
                                          <option class="text-capitalize" value="out_for_delivery" {{$order->order_status == 'out_for_delivery'?'selected':''}} >Out for delivery </option>
                                          <option value="delivered" {{$order->order_status == 'delivered'?'selected':''}} >Delivered </option>
                                          <option value="returned" {{$order->order_status == 'returned'?'selected':''}} > Returned</option>
                                          <option value="canceled" {{$order->order_status == 'canceled'?'selected':''}} >Canceled</option>
                                        </select>
                                        <label for="choices-publish-status-input" class="form-label">Payment Satus</label>
                                        <select class="form-select" name="payment_status" onchange="updatePaymentStatus('{{ $order->id }}', this.value)">
                                          <option value="paid" {{$order->payment_status == 'paid'?'selected':''}} >Paid</option>
                                          <option value="unpaid" {{$order->payment_status == 'unpaid'?'selected':''}} >Unpaid</option>
                                        </select>
                                    </div>
                                </div>
                                
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex">
                                        <h5 class="card-title flex-grow-1 mb-0"><i class="mdi mdi-truck-fast-outline align-middle me-1 text-muted"></i> Logistics Details</h5>
                                        <div class="flex-shrink-0">
                                            <a href="javascript:void(0);" class="badge bg-primary-subtle text-primary fs-11">Track Order</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="text-center">
                                        <lord-icon src="https://cdn.lordicon.com/uetqnvvg.json" trigger="loop" colors="primary:#405189,secondary:#0ab39c" style="width:80px;height:80px"></lord-icon>
                                        <h5 class="fs-16 mt-2">RQK Logistics</h5>
                                        <p class="text-muted mb-0">ID: MFDS1400457854</p>
                                        <p class="text-muted mb-0">Payment Mode : Debit Card</p>
                                    </div>
                                </div>
                            </div>
                            <!--end card-->
                            

                            <div class="card">
                              @if($order->customer)
                                <div class="card-header">
                                    <div class="d-flex">
                                        <h5 class="card-title flex-grow-1 mb-0">Customer Details</h5>
                                        <div class="flex-shrink-0">
                                            <a href="javascript:void(0);" class="link-secondary">View Profile</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <ul class="list-unstyled mb-0 vstack gap-3">
                                        <li>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0">
                                                    <img src="{{asset('images/profile/'.$order->customer->image)}}" alt="" class="avatar-sm rounded material-shadow">
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h6 class="fs-14 mb-1">{{$order->customer['name']}}</h6>
                                                    <p class="text-muted mb-0">Customer</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li><i class="ri-mail-line me-2 align-middle text-muted fs-16"></i>{{$order->customer['email']}}</li>
                                        <li><i class="ri-phone-line me-2 align-middle text-muted fs-16"></i>{{$order->customer['phone']}}</li>
                                    </ul>
                                </div>
                              @endif
                            </div>
                            <!--end card-->
                            @php($shipping=json_decode($order['shipping_address_data']))
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0"><i class="ri-map-pin-line align-middle me-1 text-muted"></i> Billing Address</h5>
                                </div>
                                @php($billing=json_decode($order['billing_address_data']))
                                  
                                @if($billing)
                                <div class="card-body">
                                    <ul class="list-unstyled vstack gap-2 fs-13 mb-0">
                                        <li class="fw-medium fs-14">{{$billing->contact_person_name}}</li>
                                        <li>{{$billing->phone}}</li>
                                        <li>{{$billing->address}}</li>
                                        <li>{{$billing->city}} - {{$billing->zip}}</li>
                                        <li>{{$billing->country}}</li>
                                    </ul>
                                </div>
                                @else
                                <div class="card-body">
                                    <ul class="list-unstyled vstack gap-2 fs-13 mb-0">
                                        <li class="fw-medium fs-14">{{$shipping->contact_person_name}}</li>
                                        <li>{{$shipping->phone}}</li>
                                        <li>{{$shipping->address}}</li>
                                        <li>{{$shipping->city}} - {{$shipping->zip}}</li>
                                        <li>{{$shipping->country}}</li>
                                    </ul>
                                </div>
                                @endif
                            </div>
                            <!--end card-->
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0"><i class="ri-map-pin-line align-middle me-1 text-muted"></i> Shipping Address</h5>
                                </div>
                                @if($shipping)
                                <div class="card-body">
                                    <ul class="list-unstyled vstack gap-2 fs-13 mb-0">
                                        <li class="fw-medium fs-14">{{$shipping->contact_person_name}}</li>
                                        <li>{{$shipping->phone}}</li>
                                        <li>{{$shipping->address}}</li>
                                        <li>{{$shipping->city}} - {{$shipping->zip}}</li>
                                        <li>{{$shipping->country}}</li>
                                    </ul>
                                </div>
                                @endif
                            </div>
                            <!--end card-->

                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0"><i class="ri-secure-payment-line align-bottom me-1 text-muted"></i> Payment Details</h5>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="flex-shrink-0">
                                            <p class="text-muted mb-0">Transactions:</p>
                                        </div>
                                        <div class="flex-grow-1 ms-2">
                                            <h6 class="mb-0">#VLZ124561278124</h6>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="flex-shrink-0">
                                            <p class="text-muted mb-0">Payment Method:</p>
                                        </div>
                                        <div class="flex-grow-1 ms-2">
                                            <h6 class="mb-0">Debit Card</h6>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="flex-shrink-0">
                                            <p class="text-muted mb-0">Card Holder Name:</p>
                                        </div>
                                        <div class="flex-grow-1 ms-2">
                                            <h6 class="mb-0">Joseph Parker</h6>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="flex-shrink-0">
                                            <p class="text-muted mb-0">Card Number:</p>
                                        </div>
                                        <div class="flex-grow-1 ms-2">
                                            <h6 class="mb-0">xxxx xxxx xxxx 2456</h6>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <p class="text-muted mb-0">Total Amount:</p>
                                        </div>
                                        <div class="flex-grow-1 ms-2">
                                            <h6 class="mb-0">$415.96</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end card-->
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->

                </div><!-- container-fluid -->
            </div><!-- End Page-content -->      
    
@endsection
@push('script')
<script>
    function updateOrderStatus(orderId, newStatus) {
        $.ajax({
            url: "{{ route('order.update-order-status') }}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                "order_id": orderId,
                "new_status": newStatus
            },
            success: function(response) {
                if (response.success) {
                    // Show success message
                    toastr.options.timeOut = 10000;
                    toastr.success(response.message);
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
            error: function(xhr, status, error) {
                alert('Failed to update order status: ' + error);
            }
        });
    }
    function updatePaymentStatus(orderId, newStatus) {
        $.ajax({
            url: "{{ route('order.update-payment-status') }}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                "order_id": orderId,
                "new_status": newStatus
            },
            success: function(response) {
                if (response.success) {
                    // Show success message
                    toastr.options.timeOut = 10000;
                    toastr.success(response.message);
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
            error: function(xhr, status, error) {
                alert('Failed to update payment status: ' + error);
            }
        });
    }
</script>

@endpush