<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>User Panel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <style>
        .chat-container {
        background-color: #f0f0f0;
        width: 100%;
        height: 400px;
        overflow-y: scroll;
        padding: 10px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    .chat-message {
        max-width: 70%;
        margin-bottom: 10px;
        padding: 10px;
        border-radius: 10px;
        display: block; /* Ensure each message appears as a block element */
        clear: both; /* Clear floats to prevent horizontal stacking */
        position: relative;
    }
    .current-user-chat {
        background-color: #dcf8c6;
        float: right; /* Float messages from the current user to the right */
        clear: both; /* Clear floats to prevent overlapping */
    }
    .distance-user-chat {
        background-color: #fff;
        float: left; /* Float messages from other users to the left */
        clear: both; /* Clear floats to prevent overlapping */
    }
    .chat-message h5 {
        margin: 0;
        font-size: 14px;
    }
    .chat-message .timestamp {
        font-size: 0.8rem;
        color: #888;
        text-align: right;
        margin-top: 5px;
    }
    </style>
</head>
<body>
    @php
        $users = App\Models\Astrologer::all();
    @endphp
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
            <div class="col-8">
                <div class="tab-content" id="nav-tabContent">
                    @foreach ($users as $user)
                        <div class="tab-pane fade" id="list-{{ $user->id }}" role="tabpanel" aria-labelledby="list-profile-list">
                            <div id="chat-container-{{ $user->id }}" class="chat-container">
                                <!-- Previous chat messages will be loaded here -->
                            </div>
                            <form class="chat-form" data-id="{{ $user->id }}" method="post">
                                @csrf
                                <input type="text" name="message" placeholder="Enter Message" class="message-input border" required>
                                <button type="submit" class="btn btn-warning">Send Message</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <audio id="notificationSound" src="{{asset('backend/assets/sound/notification.mp3')}}" preload="auto"></audio>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        var sender_id = 'user_' + @json(auth()->user()->id);
var sender_type = 'user';
var receiver_id;
var receiver_type = 'astrologer';

$.ajaxSetup({
    headers: {
        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function() {
    $('.user-list-item').click(function() {
        var getUserId = 'astrologer_' + $(this).attr('data-id');
        receiver_id = getUserId;
        console.log(receiver_id);

        // Clear chat container for the selected user
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
                sender_type: sender_type,
                receiver_id: receiver_id,
                receiver_type: receiver_type,
                message: message,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(res) {
                if (res.success) {
                    form.find('.message-input').val('');
                    let chat = res.data.message;
                    let html = `<div class="chat-message current-user-chat">
                                    <h5>` + chat + `</h5>
                                    <div class="timestamp">` + new Date().toLocaleTimeString() + `</div>
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
        data: {
            sender_id: sender_id,
            sender_type: sender_type,
            receiver_id: receiver_id,
            receiver_type: receiver_type
        },
        success: function(res) {
            if (res.success) {
                let chats = res.data;
                let html = '';
                for (let i = 0; i < chats.length; i++) {
                    let addClass = (chats[i].sender_id == sender_id) ? 'current-user-chat' : 'distance-user-chat';
                    html += `
                    <div class="chat-message ` + addClass + `">
                        <h5>` + chats[i].message + `</h5>
                        <div class="timestamp">` + new Date(chats[i].created_at).toLocaleTimeString() + `</div>
                    </div>`;
                }
                $('#chat-container-' + receiver_id).append(html);
            } else {
                alert(res.msg);
            }
        }
    });
}

document.addEventListener('DOMContentLoaded', function() {
    Echo.join('status-update')
        .here((users) => {
            for (let x = 0; x < users.length; x++) {
                let prefixedId = users[x].type + '_' + users[x].id;
                if (sender_id != prefixedId) {
                    $('#' + prefixedId + '-status').removeClass('offline-status');
                    $('#' + prefixedId + '-status').addClass('online-status');
                    $('#' + prefixedId + '-status').text('Online');
                }
            }
        })
        .joining((user) => {
            let prefixedId = user.type + '_' + user.id;
            $('#' + prefixedId + '-status').removeClass('offline-status');
            $('#' + prefixedId + '-status').addClass('online-status');
            $('#' + prefixedId + '-status').text('Online');
        })
        .leaving((user) => {
            let prefixedId = user.type + '_' + user.id;
            $('#' + prefixedId + '-status').removeClass('online-status');
            $('#' + prefixedId + '-status').addClass('offline-status');
            $('#' + prefixedId + '-status').text('Offline');
        })
        .listen('UserStatusEvent', (e) => {
            console.log('UserStatusEvent', e);
        });

    Echo.private('broadcast-message')
        .listen('.getChatMessage', (data) => {
            console.log(data);
            if (sender_id == data.chat.receiver_id && receiver_id == data.chat.sender_id) {
                let addClass = (data.chat.sender_id == sender_id) ? 'current-user-chat' : 'distance-user-chat';
                let html = `<div class="chat-message ` + addClass + `">
                                <h5>` + data.chat.message + `</h5>
                                <div class="timestamp">` + new Date(data.chat.created_at).toLocaleTimeString() + `</div>
                            </div>`;
                $('#chat-container-' + receiver_id).append(html);
                playNotificationSound();
            }
        });
});
function playNotificationSound() {
    var audio = document.getElementById('notificationSound');
    audio.play();
}

    
    </script>
</body>
</html>
