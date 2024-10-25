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

/*Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    // التحقق من أن معرف المستخدم يطابق معرف القناة
    return (int) $user->id === (int) $id;
});

Broadcast::channel('App.Models.Admin.{id}', function ($admin, $id) {
    // التحقق من أن معرف المستخدم يطابق معرف القناة
    return (int) $admin->id === (int) $id;
} , ['guards' => ['admin']]);
