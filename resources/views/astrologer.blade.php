@extends('layouts.frontend.app')

@section('title','Astrologer')

@push('css_or_js')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .stars {
            color: #fff;
        }
        .fa-star {
            font-size: 12px;
        }       
        .checked {
            color: #797979;
        }
    </style>
@endpush
@section('content')
       <section class="as_breadcrum_wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h1>Astrologer</h1> 

                        <ul class="breadcrumb"> 
                            <li><a href="/">Home</a></li>
                            <li>Astrologer</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <section class="as_about_wrapper as_padderTop80 as_padderBottom80">
            <div class="container">
                <div class="row">
                    @foreach($astrologers as $astrologer)
                    <div class="col-lg-4 col-md-6 text-center">
                      <div class="card mb-3 shadow-lg mb-5 bg-body-tertiary rounded" style="max-width: 540px;">
                         <div class="row g-0">
                           <div class="col-md-3 bg-warning">
                             <img src="{{asset('images/profile/'.$astrologer->image)}}" onerror="this.src='{{asset('backend/assets/images/demo/def.jpg')}}'"  class="img-fluid mt-3 ml-2" alt="..." style="border-radius: 100%;height: 75px;width: 75px;">
                             <div class="col-md-12 text-center">
                                 <div class="stars">
                                     <span class="fa fa-star checked"></span>
                                     <span class="fa fa-star checked"></span>
                                     <span class="fa fa-star checked"></span>
                                     <span class="fa fa-star"></span>
                                     <span class="fa fa-star"></span>
                                 </div>
                             </div>
                           </div>
                           <div class="col-md-6">
                             <div class="card-body">
                               <h5 class="card-title d-flex align-items-start" style="color: #000;">{{$astrologer->name}}</h5>
                               <p class="card-text mb-1 d-flex align-items-start">
                                  <?php
                                     $skillIds = explode(',', $astrologer->skill);
                                     $skills = DB::table('skills')
                                         ->whereIn('id', $skillIds)
                                         ->select('name', 'id')
                                         ->get();
                                     $skillNames = [];
                                     foreach ($skills as $skill) {
                                         $skillNames[] = $skill->name;
                                     }
                                     $skillNamesString = implode(', ', $skillNames);
                                    ?>
                                     {{$skillNamesString}}
                               </p>
                               <p class="card-text mb-1 d-flex align-items-start">Exp: {{$astrologer->experienceInYears}} Years </p>
                               <p class="card-text mb-1 d-flex align-items-start">
                                 
                                 
                                @if($astrologer->free_status==1)
                                  @if(Auth::check())
                                    @if(Auth::user()->free_min>0)
                                    <span class="mr-md-3" style="margin-right: 8px;color:red;"><b>Free</b></span> <del>{{$astrologer->charge}}/min</del>
                                    @else
                                    ₹ {{$astrologer->charge}}/min
                                    @endif
                                  @else
                                  <span class="mr-md-3" style="margin-right: 8px;color:red;"><b>Free</b></span> <del>{{$astrologer->charge}}/min</del> 
                                  @endif
                                 @else
                                 ₹ {{$astrologer->charge}}/min
                                 @endif
                                </p>
                             </div>
                           </div>
                           <div class="col-md-3 d-flex align-items-end mb-4 p-2">
                            @if(Auth::check())
                            @if($astrologer->free_status==1)
                             <a href="{{route('chat-request-add',$astrologer->id)}}"><button type="button" class="btn btn-outline-warning">Chat</button></a>
                            @elseif($astrologer->free_status!=1)
                            @php
                                $walletBalance = Auth::user()->wallet_balance;
                                $charge = $astrologer->charge;
                                $requiredBalance = $charge * 5;
                            @endphp
                            @if($walletBalance >= $requiredBalance)
                                <a href="{{ route('chat-request-add', $astrologer->id) }}">
                                    <button type="button" class="btn btn-outline-warning">Chat</button>
                                </a>
                            @else
                              
                              <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#wallet_{{$astrologer->id}}">Chat</button>
                        
                            @endif
                            @endif
                            @else
                            <a href="{{ route('chat-request-add', $astrologer->id) }}">
                                    <button type="button" class="btn btn-outline-warning">Chat</button>
                                </a>
                            @endif
                           </div>
                         </div>
                      </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="wallet_{{$astrologer->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <p>Minimum balance of 5 minutes (INR {{$astrologer->charge*5}}) is required to start chat with {{$astrologer->name}}</p>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancel</button>
                            <a href="{{route('wallet-recharge')}}"><button type="button" class="btn btn-outline-success">Recharge</button></a>
                          </div>
                        </div>
                      </div>
                    </div>

                    @endforeach
                    
                </div>
                   
            </div>
        </section>
        <!-- @if(auth()->check())
                    <?php
                      $chatRequests = \App\Models\ChatRequest::where('user_id',Auth::user()->id)->get();
                    ?>
                    @foreach($chatRequests as $chatRequest)
                    @if($chatRequest && $chatRequest->status!='completed')
                    
                    <div class="card mb-3 shadow-lg mb-5 bg-body-tertiary rounded" style="max-width: 295px;position: fixed;right:5px;bottom:21px;z-index: 9;">
                         <div class="row g-0">
                           <div class="col-md-3 bg-warning">
                             <img src="{{ asset('images/profile/'. $chatRequest->astrologer->image) }}" onerror="this.src='{{asset('backend/assets/images/demo/def.jpg')}}'"  class="img-fluid mt-3 ml-2" alt="{{ $chatRequest->astrologer->name }}" style="border-radius: 100%;height: 75px;width: 75px;">
                             <div class="col-md-12 text-center">
                                 Chat
                             </div>
                           </div>
                           <div class="col-md-5">
                             <div class="card-body">
                               <h5 class="card-title d-flex align-items-start" style="color: #000;">{{ $chatRequest->astrologer->name }}</h5>
                               <p class="card-text mb-1 d-flex align-items-start">is {{ $chatRequest->astrologer->chatStatus }}</p>  
                             </div>
                           </div>
                           <div class="col-md-4 d-flex align-items-end mb-4">
                             @if($chatRequest->status=='pending')
                               <form action="{{ route('cancelChatRequest', $chatRequest->id) }}" method="post">
                                   @csrf
                                   @method('DELETE')
                                   <button type="submit" class="btn btn-danger">Cancel</button>
                               </form>
                              @elseif($chatRequest->status=='accepted')
                               <a href="{{route('chat',$chatRequest->astrologer_id)}}"><button type="submit" class="btn btn-success">Accepted</button></a>
                              @endif
                           </div>
                         </div>
                    </div>
                    @endif
                    @endforeach
                    @endif -->
                    @if(auth()->check())
    <?php
        $chatRequests = \App\Models\ChatRequest::where('user_id', Auth::user()->id)->get();
        $astrologers = \App\Models\Astrologer::all();
        $users = \App\Models\User::whereNotIn('id', [auth()->user()->id])->get();
    ?>
    
    <div class="row">
        <div class="col-4">
            @if (count($users) > 0)
                <div class="list-group" id="list-tab" role="tablist">
                    @foreach ($users as $user)
                        <a class="list-group-item list-group-item-action user-list-item" id="list-profile-list" data-id="{{ $user->id }}" data-bs-toggle="list" href="#list-{{ $user->id }}" role="tab" aria-controls="list-profile">{{ $user->name }}
                            <b><sup id="{{ $user->id }}-status" class="offline-status">Offline</sup></b>
                        </a>
                    @endforeach
                </div>
            @else
                <p>No user found</p>
            @endif
        </div>
        
        <div class="col-4">
            @if (count($astrologers) > 0)
                <div class="list-group" id="astrologer-list-tab" role="tablist">
                    @foreach ($astrologers as $astrologer)
                        <a class="list-group-item list-group-item-action astrologer-list-item" id="list-profile-list" data-id="{{ $astrologer->id }}" data-bs-toggle="list" href="#list-{{ $astrologer->id }}" role="tab" aria-controls="list-profile">{{ $astrologer->name }}
                            <b><sup id="{{ $astrologer->id }}-status" class="offline-status">Offline</sup></b>
                        </a>
                    @endforeach
                </div>
            @else
                <p>No astrologer found</p>
            @endif
        </div>

        <div class="col-4">
            @foreach ($chatRequests as $chatRequest)
                @if($chatRequest && $chatRequest->status != 'completed')
                    <div class="card mb-3 shadow-lg mb-5 bg-body-tertiary rounded" style="max-width: 295px; position: fixed; right: 5px; bottom: 21px; z-index: 9;">
                        <div class="row g-0">
                            <div class="col-md-3 bg-warning">
                                <img src="{{ asset('images/profile/'. $chatRequest->astrologer->image) }}" onerror="this.src='{{ asset('backend/assets/images/demo/def.jpg') }}'" class="img-fluid mt-3 ml-2" alt="{{ $chatRequest->astrologer->name }}" style="border-radius: 100%; height: 75px; width: 75px;">
                                <div class="col-md-12 text-center">Chat</div>
                            </div>
                            <div class="col-md-5">
                                <div class="card-body">
                                    <h5 class="card-title d-flex align-items-start" style="color: #000;">{{ $chatRequest->astrologer->name }}</h5>
                                    <p class="card-text mb-1 d-flex align-items-start">is {{ $chatRequest->astrologer->chatStatus }}</p>
                                </div>
                            </div>
                            <div class="col-md-4 d-flex align-items-end mb-4">
                                @if($chatRequest->status == 'pending')
                                    <form action="{{ route('cancelChatRequest', $chatRequest->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Cancel</button>
                                    </form>
                                @elseif($chatRequest->status == 'accepted')
                                    <a href="{{ route('chat', $chatRequest->astrologer_id) }}"><button type="button" class="btn btn-success">Accepted</button></a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
@endif

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    var sender_id = @json(auth()->user()->id);
    var receiver_id;

    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function() {
        $('.user-list-item, .astrologer-list-item').click(function() {
            var getUserId = $(this).attr('data-id');
            receiver_id = getUserId;
            console.log(receiver_id);

            // Clear chat container for the selected user/astrologer
            $('#chat-container-' + receiver_id).html('');
            loadOldChats();
        });

        $(document).on('submit', '.chat-form', function(e) {
            e.preventDefault();
            var form = $(this);
            var message = form.find('.message-input').val();

            $.ajax({
                url: "/save-chat",
                type: "POST",
                data: {
                    sender_id: sender_id,
                    receiver_id: receiver_id,
                    message: message,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(res) {
                    if (res.success) {
                        form.find('.message-input').val('');
                        let chat = res.data.message;
                        let html = `<div class="current-user-chat">
                                        <h5>` + chat + `</h5>
                                    </div>`;
                        $('#chat-container-' + receiver_id).append(html);
                    } else {
                        alert(res.msg);
                    }
                }
            });
        });
    });

    function loadOldChats() {
        $.ajax({
            url: "/load-chats",
            type: "POST",
            data: { sender_id: sender_id, receiver_id: receiver_id },
            success: function(res) {
                if (res.success) {
                    let chats = res.data;
                    let html = '';
                    for (let i = 0; i < chats.length; i++) {
                        let addClass = '';
                        if (chats[i].sender_id == sender_id) {
                            addClass = 'current-user-chat';
                        } else {
                            addClass = 'distance-user-chat';
                        }
                        html += `<div class="` + addClass + `">
                                    <h5>` + chats[i].message + `</h5>
                                </div>`;
                    }
                    $('#chat-container-' + receiver_id).html(html);
                }
            }
        });
    }

    Echo.join('status-update')
        .here((users) => {
            for (let x = 0; x < users.length; x++) {
                if (sender_id != users[x]['id']) {
                    $('#' + users[x]['id'] + '-status').removeClass('offline-status');
                    $('#' + users[x]['id'] + '-status').addClass('online-status');
                    $('#' + users[x]['id'] + '-status').text('Online');
                }
            }
        })
        .joining((user) => {
            $('#' + user.id + '-status').removeClass('offline-status');
            $('#' + user.id + '-status').addClass('online-status');
            $('#' + user.id + '-status').text('Online');
        })
        .leaving((user) => {
            $('#' + user.id + '-status').removeClass('online-status');
            $('#' + user.id + '-status').addClass('offline-status');
            $('#' + user.id + '-status').text('Offline');
        });

    Echo.private('broadcast-message')
        .listen('.getChatMessage', (data) => {
            if (sender_id == data.chat.receiver_id && receiver_id == data.chat.sender_id) {
                let html = `<div class="distance-user-chat">
                                <h5>` + data.chat.message + `</h5>
                            </div>`;
                $('#chat-container-' + receiver_id).append(html);
            }
        });

    Echo.private('astrologerStatusUpdate')
        .listen('.astrologerStatusUpdate', (data) => {
            if (data.type == 'astrologer') {
                $('#' + data.id + '-status').removeClass('offline-status');
                $('#' + data.id + '-status').addClass('online-status');
                $('#' + data.id + '-status').text('Online');
            }
        });
</script>

@endsection