@extends('layouts.frontend.app')

@section('title','Chatting')

@push('css_or_js')
@vite(['resources/css/app.css', 'resources/js/app.js'])
<link rel="stylesheet" href="{{asset('frontend/assets/css/table.css')}}">
@endpush
@section('content')
<section class="as_padderTop80 as_padderBottom80 page_margin" style="margin-top: 133px;">
    <div class="container">
        <h3 style="text-align: center;color:#000">My Wallet</h3>
        <div class="row">
           @include('layouts.frontend.partial.side-bar')
           @if (isset($unique_astrologers))

                <div class="col-lg-3 chatSel">
                    <div class="card __shadow">
                        <div class="inbox_people">
                            <div class="headind_srch">
                                <form
                                    class="form-inline d-flex justify-content-center md-form form-sm active-cyan-2 mt-2">
                                    <input
                                        class="form-control form-control-sm border-0 w-75"
                                        id="myInput" type="text" placeholder="Search" aria-label="Search">
                                    <i class="fa fa-search __color-92C6FF" aria-hidden="true"></i>
                                </form>
                                <hr>
                            </div>
                            <div class="inbox_chat">
                                @if (isset($unique_astrologers))
                                    @foreach($unique_astrologers as $key=>$astrologer)
                                        <div class="chat_list @if ($key == 0) btn--primary @endif"
                                             id="user_{{$astrologer->astrologer_id}}">
                                            <div class="chat_people" id="chat_people">
                                                <div class="chat_img">
                                                    <img onerror="this.src='{{asset('backend/assets/images/demo/def.jpg')}}'" src="{{asset('images/profile/'.$astrologer->image)}}"
                                                        class="__rounded-10">
                                                </div>
                                                <div class="chat_ib">
                                                    <h5 class="seller @if($shop->seen_by_customer)active-text @endif"
                                                        id="{{$astrologer->shop_id}}">{{$astrologer->name}}</h5>
                                                </div>
                                            </div>
                                        </div>
                                    @endForeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <section class="col-lg-6">
                    <div class="card Chat __shadow">
                        <div class="messaging">
                            <div class="inbox_msg">

                                <div class="mesgs">
                                    <div class="msg_history" id="show_msg">
                                        @if (isset($chattings))

                                            @foreach($chattings as $key => $chat)
                                                @if ($chat->sent_by_astrologer)
                                                    <div class="incoming_msg">
                                                        <div class="incoming_msg_img"><img
                                                                src="@if($chat->image == 'def.png'){{asset('images/'.$chat->image)}} @else {{ asset('images/profile/'.$last_chat->astrologer->image)}}
                                                                @endif"
                                                                alt="sunil"></div>
                                                        <div class="received_msg">
                                                            <div class="received_withd_msg">
                                                                <p>
                                                                    {{$chat->message}}
                                                                </p>
                                                                <span class="time_date"> {{$chat->created_at->format('h:i A')}}    |    {{$chat->created_at->format('M d')}} </span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                @else

                                                    <div class="outgoing_msg">
                                                        <div class="send_msg">
                                                            <p class="btn--primary">
                                                                {{$chat->message}}
                                                            </p>
                                                            <span class="time_date"> {{$chat->created_at->format('h:i A')}}    |    {{$chat->created_at->format('M d')}} </span>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endForeach
                                            {{-- for scroll down --}}
                                            <div id="down"></div>
                                        @endif
                                    </div>
                                    <div class="type_msg">
                                        <div class="input_msg_write">
                                            <form
                                                class="form-inline d-flex justify-content-center md-form form-sm active-cyan-2 mt-2"
                                                id="myForm">
                                                @csrf
                                                @if( Request::is('chat/astrologer') )
                                                    <input type="text" id="hidden_value" hidden
                                                           value="{{$last_chat->astrologer_id}}" name="">
                                                    @if($last_chat->astrologer)
                                                        <input type="text" id="seller_value" hidden
                                                               value="{{$last_chat->astrologer->astrologer_id}}" name="">
                                                    @endif
                                                @endif
                                                <input class="form-control form-control-sm w-75"
                                                    id="msgInputValue" type="text" placeholder="Send a message" aria-label="Search">
                                                <input class="aSend __w-45px" type="submit" id="msgSendBtn" value="Send">

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            @else
                <div class="col-md-8 d-flex justify-content-center align-items-center">
                    <p>No conversation found'</p>
                </div>
            @endif
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