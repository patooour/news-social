<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    public function redirect($provider){
      return Socialite::driver($provider)->redirect();
    }

    public function callback($provider){
        $user = Socialite::driver($provider)->user();

        /*if (User::whereEmail($user->email)->exists()) {

        }*/
        $user_db =  User::updateorcreate([
            'email' => $user->email,
        ],[
            'name' => $user->name,
            'email'     => $user->email,
            'google_id' =>$user->id,
            'username'=>Str::replace(' ' , '-' , $user->name).time(),
            'image'=>$user->avatar,
          /*  'country'=>$user->id,
            'city'=>$user->id,
            'phone'=>$user->id,
            'street'=>$user->id,*/
            'email_verified_at' => now(),
            'password'=>bcrypt(Str::random(8)),
        ]);

        Auth::login($user_db);

        return redirect()->route('fronted.index');
    }
}
