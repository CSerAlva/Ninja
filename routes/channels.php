<?php

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

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int)$user->id === (int)$id;
});

////私有频道 设置频道权限
Broadcast::channel('three_good_Leo', function ($user) {
    $ids = [1, 2, 3, 4];

    return in_array($user->id, $ids);
});

//频道认证路由
Broadcast::channel('chat.{roomId}', function ($user, $roomId) {
//    if ($user->canJoinRoom($roomId)) {
    return ['id' => $user->id, 'name' => $user->name];
//    }
});

//4.定义频道授权 Leo
Broadcast::channel('channel', function () {
//    return true;
}, ['guards' => ['web', 'admin']]);

//5.定义频道类 Leo
//php artisan make:channel OrderChannel
//Broadcast::channel('order.{order}',\App\Broadcasting\OrderChannel::class);

Broadcast::channel('chat', function () {
    return true;
});
