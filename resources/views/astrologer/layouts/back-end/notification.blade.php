<div class="dropdown topbar-head-dropdown ms-1 header-item" id="notificationDropdown">
                         <button type="button" class="btn btn-icon btn-topbar material-shadow-none btn-ghost-secondary rounded-circle" id="page-header-notifications-dropdown" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false">
                             <i class='bx bx-bell fs-22'></i>
                             <span class="position-absolute topbar-badge fs-10 translate-middle badge rounded-pill bg-danger">{{auth('astrologer')->user()->notifications->count()}}<span class="visually-hidden">unread messages</span></span>
                         </button>
                         <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-notifications-dropdown">
                             <div class="dropdown-head bg-primary bg-pattern rounded-top">
                                 <div class="p-3">
                                     <div class="row align-items-center">
                                         <div class="col">
                                             <h6 class="m-0 fs-16 fw-semibold text-white"> Notifications </h6>
                                         </div>
                                         <div class="col-auto dropdown-tabs">
                                             <span class="badge bg-light text-body fs-13"> 4 New</span>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                             <div class="tab-content position-relative" id="notificationItemsTabContent">
                                 <div class="tab-pane fade show active py-2 ps-2" id="all-noti-tab" role="tabpanel">
                                     <div data-simplebar style="max-height: 300px;" class="pe-2">
                                         
                                         @foreach(auth('astrologer')->user()->notifications as $notification)
                                         <div class="text-reset notification-item d-block dropdown-item">
                                            <div class="d-flex">
                                                <img onerror="this.src='{{asset('backend/assets/images/demo/def.jpg')}}'" src="{{asset('images/profile/'.$notification->data['user_image'])}}" class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                                <div class="flex-grow-1">
                                                    <a href="#!" class="stretched-link">
                                                        <h6 class="mt-0 mb-1 fs-13 fw-semibold">{{$notification->data['user_name']}}</h6>
                                                    </a>
                                                    <div class="fs-13 text-muted">
                                                        <p class="mb-1">{{$notification->data['message']}}</p>
                                                    </div>
                                                    <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                        <span><i class="mdi mdi-clock-outline"></i> {{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</span>
                                                    </p>
                                                </div>
                                                <div class="px-2 fs-15">
                                                    <div class="form-check notification-check">
                                                        <input class="form-check-input" type="checkbox" value="" id="messages-notification-check01">
                                                        <label class="form-check-label" for="messages-notification-check01"></label>
                                                    </div>
                                                </div>
                                            </div>
                                         </div>
                                         @endforeach
                                         <div class="my-3 text-center view-all">
                                             <button type="button" class="btn btn-soft-success waves-effect waves-light">View
                                                 All Notifications <i class="ri-arrow-right-line align-middle"></i></button>
                                         </div>
                                     </div>
                                 </div>    
                             </div>
                         </div>
                        </div>