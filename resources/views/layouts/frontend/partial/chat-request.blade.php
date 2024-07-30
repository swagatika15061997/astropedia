@php
                                  $chat_request = App\Models\ChatRequest::where('user_id',Auth::user()->id)
                                                  ->orderBy('created_at', 'desc')
                                                  ->take(5)
                                                  ->get();
                                @endphp
<div class="notification_dd">
                                      <ul class="notification_ul">
                                        @if($chat_request->isEmpty())
                                          <li class="show_all">
                                              <p class="link">No request found</p>
                                           </li> 
                                        @else
                                          @foreach($chat_request as $chat_req)
                                          @if($chat_req->status == 'rejected')
                                          <li class="baskin_robbins failed">
                                              <div class="notify_icon">
                                                  <span class="icon">
                                                    <img  onerror="this.src='{{asset('backend/assets/images/demo/def.jpg')}}'" src="{{asset('images/profile/'.$chat_req->astrologer->image)}}"
                                                    class="img-profile rounded-circle __inline-14">
                                                  </span>  
                                              </div>
                                              <div class="notify_data">
                                                  <div class="title">
                                                      {{$chat_req->astrologer->name}}  
                                                  </div>
                                                  <div class="sub_title">
                                                    {{$chat_req->created_at}}
                                                  </div>
                                              </div>
                                              <div class="notify_status">
                                                  <p>{{$chat_req->status}} </p>  
                                              </div>
                                          </li>
                                          @else 
                                          <li class="starbucks success">
                                          <div class="notify_icon">
                                                  <span class="icon">
                                                    <img  onerror="this.src='{{asset('backend/assets/images/demo/def.jpg')}}'" src="{{asset('images/profile/'.$chat_req->astrologer->image)}}"
                                                    class="img-profile rounded-circle __inline-14">
                                                  </span>  
                                              </div>
                                              <div class="notify_data">
                                                  <div class="title">
                                                      {{$chat_req->astrologer->name}}  
                                                  </div>
                                                  <div class="sub_title">
                                                    {{$chat_req->created_at}}
                                                  </div>
                                              </div>
                                              <div class="notify_status">
                                                  <p>{{$chat_req->status}} </p>  
                                              </div>
                                          </li>  
                                          @endif
                                          @endforeach
                                          <li class="show_all">
                                              <p class="link">Show All Activities</p>
                                          </li> 
                                        @endif
                                      </ul>
                                  </div>