<?php

namespace App\Http\Controllers\frontend\dashboard;

use App\Http\Controllers\Controller;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function getNotification(){
       /* Auth::user()->unreadNotifications->markAsRead();*/
        return view('fronted.dashboard.notification');
    }

    public function delete(Request $request){
        $notificatons = Auth::user()->notifications()
            ->where('id' , $request->notify_id)->first();

       if (!$notificatons) {
           Flasher::addError('try again later');
           return redirect()->back();
       }
        $notificatons->delete();
        Flasher::addSuccess('notification delete success');
        return redirect()->back();
    }
    public function deleteAll(Request $request)
    {
        $notificatons = Auth::user()->notifications()->delete();
        Flasher::addSuccess('notifications has been deleted');
        return redirect()->back();
    }
}
