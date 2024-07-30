<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Astrologer Panel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <style>
        .chat-container {
            background-color: lightblue;
            width: 100%;
            height: 400px;
            overflow-y: scroll;
        }
        .current-user-chat {
            text-align: right;
            margin: 10px;
            color: #000;
        }
        .offline-status {
            color: red;
        }
        .online-status {
            color: green;
        }
    </style>
</head>
<body>
    @php
        $users = App\Models\User::all();
    @endphp
    <div class="row">
        <div class="col-4">
            @if (count($users) > 0)
                <div class="list-group" id="list-tab" role="tablist">
                    @foreach ($users as $user)
                        <a class="list-group-item list-group-item-action user-list-item" id="user-{{ $user->id }}-profile-list" data-id="{{ $user->id }}" data-type="user" data-bs-toggle="list" href="#list-user-{{ $user->id }}" role="tab" aria-controls="list-profile">{{ $user->name }}
                            <b><sup id="user-{{ $user->id }}-status" class="offline-status">Offline</sup></b>
                        </a>
                    @endforeach
                </div>
            @else
                <p>No user found</p>
            @endif
        </div>
        <div class="col-8">
            <div class="tab-content" id="nav-tabContent">
                @foreach ($users as $user)
                    <div class="tab-pane fade" id="list-user-{{ $user->id }}" role="tabpanel" aria-labelledby="user-{{ $user->id }}-profile-list">
                        <div id="chat-container-user-{{ $user->id }}" class="chat-container">
                            <!-- Previous chat messages will be loaded here -->
                        </div>
                        <form class="chat-form" data-id="{{ $user->id }}" data-type="user" method="post">
                            <input type="text" name="message" placeholder="Enter Message" class="message-input border" required>
                            <button type="submit" class="btn btn-warning">Send Message</button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        var astrologer_id = @json(auth('astrologer')->user()->id);
        var user_id;

        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            $('.user-list-item').click(function() {
                var getUserId = $(this).attr('data-id');
                var getUserType = $(this).attr('data-type');
                user_id = getUserId;
                console.log(user_id);

                // Clear chat container for the selected user
                $('#chat-container-user-' + user_id).html('');
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
                        astrologer_id: astrologer_id,
                        user_id: user_id,
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
                            $('#chat-container-user-' + user_id).append(html);
                        } else {
                            alert(res.msg);
                        }
                    }
                });
            });
        });
      
        function loadOldChats(){
            $.ajax({
                url:"/load-chats",
                type:"POST",
                data:{ astrologer_id: astrologer_id, user_id: user_id},
                success:function(res){
                    if(res.success){
                        let chats = res.data;
                        let html = '';
                        for(let i=0; i < chats.length; i++){
                            let addClass = '';
                            if(chats[i].astrologer_id == astrologer_id){
                                addClass = 'current-user-chat';
                            }  
                            else{
                                addClass = 'distance-user-chat';
                            }
                            html+=`
                            <div class=`+addClass+`>
                                <h5>`+chats[i].message+`</h5>
                            </div>`;
                        }
                        $('#chat-container-user-' + user_id).append(html);
                    }
                    else{
                        alert(res.msg);
                    }
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            Echo.join('status-update')
                .here((users) => {
                    for (let x = 0; x < users.length; x++) {
                        console.log(users[x]['id']);
                        // if (astrologer_id != users[x]['id']) {
                            $('#user-' + users[x]['id'] + '-status').removeClass('offline-status');
                            $('#user-' + users[x]['id'] + '-status').addClass('online-status');
                            $('#user-' + users[x]['id'] + '-status').text('Online');
                        // }
                    }
                })
                .joining((user) => {
                    $('#user-' + user.id + '-status').removeClass('offline-status');
                    $('#user-' + user.id + '-status').addClass('online-status');
                    $('#user-' + user.id + '-status').text('Online');
                })
                .leaving((user) => {
                    $('#user-' + user.id + '-status').removeClass('online-status');
                    $('#user-' + user.id + '-status').addClass('offline-status');
                    $('#user-' + user.id + '-status').text('Offline');
                })
                .listen('UserStatusEvent', (e) => {
                    console.log('UserStatusEvent', e);
                });

            Echo.private('broadcast-message')
                .listen('.getChatMessage', (data) => {
                    console.log(data);
                    if (astrologer_id == data.chat.user_id && user_id == data.chat.astrologer_id) {
                        let html = `<div class="distance-user-chat">
                                        <h5>` + data.chat.message + `</h5>
                                    </div>`;
                        $('#chat-container-user-' + user_id).append(html);
                    }
                });
        });
    </script>
</body>
</html>
