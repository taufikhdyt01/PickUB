<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('websocket-channel', function ($user) {
    return true;
});

Broadcast::channel('conversation.{conversationId}', function ($user, $conversationId) {
    return true;
});
