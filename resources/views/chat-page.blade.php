@extends('layouts.frontend.app')

@section('title', 'Chat')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <img src="{{ asset('images/profile/'. $chatRequest->astrologer->image) }}" onerror="this.src='{{ asset('backend/assets/images/demo/def.jpg') }}'" class="img-fluid" alt="{{ $chatRequest->astrologer->name }}" style="border-radius: 100%; height: 75px; width: 75px;">
                    <span>{{ $chatRequest->astrologer->name }}</span>
                </div>

                <div class="card-body">
                    <div id="chatContent"></div>
                </div>

                <div class="card-footer">
                    <span id="timer"></span>
                    <button id="endChatButton" class="btn btn-danger">End Chat</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let freeMinutes = {{ Auth::user()->free_min }};
    let timer = freeMinutes * 60; // Convert free minutes to seconds
    let chatInterval;
    let totalMinutes = 0;
    let chatEnded = false; // Track if chat has ended

    function startTimer() {
        chatInterval = setInterval(() => {
            if (timer > 0) {
                timer--;
                if (timer % 60 === 0) {
                    totalMinutes++;
                }
                document.getElementById('timer').textContent = formatTime(timer);
            } else {
                clearInterval(chatInterval);
                endChat();
            }
        }, 1000);
    }

    function formatTime(seconds) {
        const minutes = Math.floor(seconds / 60);
        const remainingSeconds = seconds % 60;
        return `${minutes}:${remainingSeconds < 10 ? '0' : ''}${remainingSeconds}`;
    }

    function endChat() {
        if (chatEnded) return; // Prevent multiple calls to endChat

        chatEnded = true;

        fetch('{{ route("chat.end") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                total_minutes: totalMinutes,
                astrologer_id: {{ $chatRequest->astrologer->id }}
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                alert(data.message);
                window.location.href = '{{ route('astrologer') }}';
            } else {
                alert(data.message);
            }
        });
    }

    document.getElementById('endChatButton').addEventListener('click', endChat);

    window.onload = function() {
        startTimer();
    }
</script>
@endsection
