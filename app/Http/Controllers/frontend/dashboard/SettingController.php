<?php

namespace App\Http\Controllers\frontend\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\frontend\SettingRequest;
use App\Models\User;
use App\Utils\imageManager;
use Flasher\Prime\Flasher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
    public function getSetting(){
        $user = Auth::user();

        return view('fronted.dashboard.setting',compact('user'));
    }

    public function update(SettingRequest $request)
    {

        $request->validated();
        $user = User::findorfail(Auth::user()->id);
        $user->update($request->except(['_token' , 'image']));

       imageManager::checkImageToUpload($request,$user, 'uploads/users');

        \Flasher\Laravel\Facade\Flasher::addSuccess('setting updated successfully');
        return redirect()->back();
    }

    public function changePassword(Request $request){

        $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed',
        ]);

        if (!Hash::check($request->get('current_password') , Auth::user()->password)){
            \Flasher\Laravel\Facade\Flasher::adderror('Current password does not match');
            return redirect()->back();
        }

        $user = User::findorfail(Auth::user()->id);
        $user->update([
            'password' => Hash::make($request->get('password'))
        ]);

        \Flasher\Laravel\Facade\Flasher::addSuccess('Password Changed Successfully');
        return redirect()->back();
    }
}
