<?php

namespace App\Http\Controllers\Api\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\frontend\SettingRequest;
use App\Models\User;
use App\Utils\imageManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
    public function updateSetting(SettingRequest $request )
    {
        $request->validated();
        $user = User::find(auth()->user()->id);
        if (!$user){
            return apiSuccessResponse(404 , 'user not found');
        }
        $user->update($request->except(['_method' , 'image']));
        imageManager::checkImageToUpload($request,$user, 'uploads/users');
        return apiSuccessResponse(200 , 'user updated successfully');
    }


    public function changePassword(Request $request ){

        $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed|min:6|max:30',
        ]);
        $user = User::find(Auth::guard('sanctum')->user()->id);
        if (!$user){
            return apiSuccessResponse(404 , 'user not found');

        }
        if (!Hash::check($request->get('current_password') ,
            Auth::guard('sanctum')->user()->password)){
            return apiSuccessResponse(404 , 'current password does not match');
        }


        $user->update([
            'password' => $request->get('password')
        ]);

        return apiSuccessResponse(200 , 'password updated successfully');

    }
}
