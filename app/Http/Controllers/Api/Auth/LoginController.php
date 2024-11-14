<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:100',
            'password' => 'required'
        ]);
        if (RateLimiter::tooManyAttempts($request->ip(), 2)) {
            $time = RateLimiter::availableIn($request->ip());
            return apiSuccessResponse(429 , 'try again after :'.$time);
        }
        RateLimiter::increment($request->ip());
        $remain = RateLimiter::remaining($request->ip() , 2);
        $user = User::whereEmail($request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            $token = $user->createToken( 'token' , [] , now()->addMinutes(60) )->plainTextToken;
            return apiSuccessResponse(200 , 'login success' , ['token' => $token]);
        }
        return apiSuccessResponse(401 , 'auth failed' ,['remain' => $remain]);

    }
    public function logout()
    {
       $user =  Auth::guard('sanctum')->user();
        $user->currentAccessToken()->delete();
        return apiSuccessResponse(200 , 'Token deleted success' );
    }
}
