<?php

namespace App\Http\Controllers\Api\Auth\Password;

use App\Http\Controllers\Controller;
use App\Models\User;
use Ichtrojan\Otp\Otp;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    protected $otp;
    public function __construct()
    {
        $this->otp = new Otp;
    }
    public  function ResetPassword(Request $request)
    {
        $request->validate($this->filterRequest());
        $user = User::whereEmail($request->email)->first();
        if (!$user){
            return apiSuccessResponse(404 ,'user not found');

        }
        $otp2 = $this->otp->validate($user->email , $request->otp);

        if ($otp2->status == false){
            return apiSuccessResponse(500 , $otp2->message);
        }
        $user->update(['password'=>$request->password]);
        $token = $user->createToken($user->name)->plainTextToken;
        return apiSuccessResponse(200 , 'pass changed successfully' ,['token'=>$token]);

    }

    protected function filterRequest()
    {
        $data = [
            'email' => 'required|string|email|exists:users,email',
            'otp' => 'required|min:5|max:8',
            'password' => 'required|string|min:6|confirmed',
        ];
        return $data;
    }
}
