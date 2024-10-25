<?php

namespace App\Http\Controllers\Admin\Dashboard\Notification;

use App\Http\Controllers\Controller;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:notifications');
    }

    public function index(){
        Auth::user('admin')->unreadNotifications->markAsRead();
        $notifications = auth('admin')->user()->notifications()->get();

        return view('dashboard.notification.index',compact('notifications'));
    }

    public function destroy($id){
        $notify = auth('admin')->user()->notifications()->find($id);
        if(!$notify){
            return response()->json([
                'status' => false,
                'message' => 'Sorry, notification with id ' . $id . ' cannot be found',
                'data' => null,
            ]);
        }
        $notify->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Notification has been deleted successfully',
            'data' => $id,
        ]);
    }
    public function deleteAll(){
        $notify = auth('admin')->user()->notifications()->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Notifications has been deleted successfully',
            'data' => null,
        ]);
    }

}
