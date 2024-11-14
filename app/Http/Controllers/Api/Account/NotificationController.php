<?php

namespace App\Http\Controllers\Api\Account;

use App\Http\Controllers\Controller;
use App\Http\Resources\notification\NotificationResource;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function getNotifications(){
        $user = auth()->guard('sanctum')->user();

        $notifications = $user->notifications;

        $unreadNotifications = $user->unreadNotifications;

        return apiSuccessResponse(200 , 'notifications' , [
            'unreadNotifications' => NotificationResource::collection($unreadNotifications),
            'notification' => NotificationResource::collection($notifications),

        ]);
    }

    public function readNotification($id)
    {
        $notification = auth()->guard('sanctum')->user()
            ->unreadNotifications()->where('id', $id)->first();

        if($notification){
            return apiSuccessResponse(404 , 'notification not ');
        }
        $notification->markAsRead();
        return apiSuccessResponse(200 , 'notification read successfully');

    }
}
