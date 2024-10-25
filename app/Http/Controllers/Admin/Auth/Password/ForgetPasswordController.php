<?php

namespace App\Http\Controllers\Admin\Auth\Password;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Notifications\SendOtpNotify;
use Ichtrojan\Otp\Otp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ForgetPasswordController extends Controller
{
    public $otp;
    public function __construct()
    {
        $this->otp = new otp;
    }

    public function showEmailForm(){
        return view('dashboard.auth.passwords.email');
    }

    public function sendOTP(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);
    $admin =  Admin::where('email' , $request->email)->first();
    if (!$admin){
        return redirect()->back()->withErrors(['try again later']);
    }
    $admin->notify(new SendOtpNotify());
        return redirect()->route('admin.password.email.verify' , ['email'=>$admin->email]);
    }

    public function getConfirmView($email){

        return view('dashboard.auth.passwords.confirm' , ['email'=>$email]);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
           'email' => 'required|email',
           'token' => 'required|min:5',
        ]);
        $otp2 = $this->otp->validate($request->email , $request->token);
        if ($otp2->status == false){
            return redirect()->back()->withErrors([$otp2->message]);
        }
        return redirect()->route('admin.password.resetPassword' , ['email'=>$request->email]);
    }
}
