<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Notifications\Api\sendOtpAfterRegisterNotify;
use Ichtrojan\Otp\Otp;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifyEmailController extends Controller
{
    protected $otp;
    public function __construct()
    {
        $this->otp = new Otp;
    }

    public function VerifyEmail(Request $request)
    {
         $user =  $request->user();

        $request->validate([
            'otp' => 'required|max:8',
        ]);

        $otp2 = $this->otp->validate($user->email , $request->otp);

        if ($otp2->status == false){
          return apiSuccessResponse(500 , 'internal server error');
        }
        $user->update(['email_verified_at' => now()]);
        return apiSuccessResponse(200 , 'emil verified successfully');

    }

    public function sendOtpAgain(){
        $user =  \request()->user();
        $user->notify( new sendOtpAfterRegisterNotify() );
        return apiSuccessResponse(200 , 'otp send successfully');

    }
}
