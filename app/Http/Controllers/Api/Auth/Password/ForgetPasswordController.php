<?php

namespace App\Http\Controllers\Api\Auth\Password;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\Api\sendOtpAfterRegisterNotify;
use App\Notifications\Api\sendOtpResetPassNotify;
use Illuminate\Http\Request;

class ForgetPasswordController extends Controller
{
    public function passwordOtpSent(Request $request )
    {
        $request->validate([
            'email' => 'required|string|email|max:80|exists:users,email',
        ]);
        $user = User::whereEmail($request->email)->first();
        if (!$user){
            return apiSuccessResponse(404 , 'user not found');
        }
        $user->notify(new sendOtpResetPassNotify());
        return apiSuccessResponse(200 , 'check email');
    }
}
