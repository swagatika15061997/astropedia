<?php

use App\Models\User;
use App\Models\Astrologer;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.Astrologer.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});


Broadcast::channel('status-update', function ($user) {
    return [
        'id' => get_class($user) == 'App\Models\Astrologer' ? $user->id  : 'astro_'.$user->id,
        'type' => get_class($user) == 'App\Models\Astrologer' ? 'astrologer' : 'user',
    ];
}, ['guards' => ['web', 'astrologer']]);


Broadcast::channel('broadcast-message', function ($user) {
    return $user;
}, ['guards' => ['web', 'astrologer']]);
