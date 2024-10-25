<?php

namespace App\Http\Controllers\Admin\Auth\Password;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    public function resetPassword($email){

        return view('dashboard.auth.passwords.reset' , ['email' => $email]);
    }

    public function updatePassword(Request $request){
       $request->validate([
          'email' => 'required|email',
          'password' => 'required|min:8|confirmed',
       ]);

       $admin = Admin::where('email' , $request->email)->first();

       if (!$admin) {
           return redirect()->back()->withErrors(['email is not registered']);
       }
            $admin->update([
                'password'=>bcrypt($request->password)
            ]);

       return redirect()->route('admin.login.show')
           ->with(['success'=>'Password reset successfully']);

    }
}
