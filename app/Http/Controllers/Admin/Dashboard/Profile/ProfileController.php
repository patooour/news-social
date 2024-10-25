<?php

namespace App\Http\Controllers\Admin\Dashboard\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\ProfileRequest;
use App\Models\Admin;
use App\Notifications\SendOtpNotify;
use Flasher\Laravel\Facade\Flasher;
use http\Env\Response;
use Ichtrojan\Otp\Otp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    private $otp ;
    public function __construct()
    {
        $this->middleware('can:profile');
        $this->otp = new Otp;
    }

    public function index()
    {
        return view('dashboard.profile.index');
    }

    public function update(ProfileRequest $request, $id)
    {
        $admin = Admin::findorfail($id);
        $result = Hash::check($request->current_password, $admin->password);

        if (!$result) {
            Flasher::addError('password not match , try again later');
            return redirect()->back();
        } else {
            if ($request->filled('password')) {
                $request->merge([
                    'password' => bcrypt($request->password)
                ]);
            }else{
                $request->request->remove('password');
            }
            $admin = $admin->update($request->except('_token','current_password'));

            Flasher::addSuccess('profile updated successfully');
            return redirect()->back();
        }

    }
    public function sentOtp($email){


        $admin =  Admin::where('email' , $email)->first();
        if (!$admin){
            return \response()->json([
                'status' => false,
                'message' => 'Send OTP Failed',

            ]);
        }
        $admin->notify(new SendOtpNotify());
        return \response()->json([
            'status' => 'success',
            'message' => 'Send OTP success',

        ]);
    }

    public function verifyOtp(Request $request){

        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|min:5',
        ]);
        $otp2 = $this->otp->validate($request->email , $request->otp);

        if ($otp2->status == false){
            Flasher::addError($otp2->message);
            return redirect()->back();
        }
        return redirect()->route('dashboard.profile.passwords.reset');
    }

}
