<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\UserRequest;
use App\Jobs\SendOtpTask;
use App\Models\User;
use App\Notifications\Api\sendOtpAfterRegisterNotify;
use App\Utils\imageManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function register(UserRequest $request){
            DB::beginTransaction();
        try {
            $request->validated();
            $user =  User::create([
                'name' => $request->post('name'),
                'email' => $request->post('email'),
                'username' => $request->post('username'),
                'phone' => $request->post('phone'),
                'country' => $request->post('country'),
                'city' =>$request->post('city'),
                'street' =>$request->post('street'),
                'password' => $request->post('password'),
            ]);

            imageManager::checkImageToUpload($request , $user , 'uploads/users');
            $token = $user->createToken( $user->name , [] , now()->addMinutes(60) )->plainTextToken;
            $user-> notify(new sendOtpAfterRegisterNotify());
            DB::commit();

        }catch (\Exception $exception){
            DB::rollBack();
            Log::error('error from register: '. $exception->getMessage());
            return apiSuccessResponse(500 , 'error in register' , );
        }
        return apiSuccessResponse(200 , 'user register successfully' ,['token' => $token ]);

    }
}
