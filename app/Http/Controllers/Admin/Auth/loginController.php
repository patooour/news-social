<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class loginController extends Controller
{

    public function __construct()
    {
        $this->middleware(['guest:admin'])->only(['showLoginForm','checkAuth']);
        $this->middleware(['auth:admin'])->except(['showLoginForm','checkAuth']);
    }
    public function showLoginForm(){

        return view('dashboard.auth.admin_login');
    }

    public function checkAuth(Request $request){
       $request->validate($this->rules());

      $result =  auth('admin')->attempt([
           'email'=>$request->get('email'),
           'password'=>$request->get('password')] , $request->get('remember_me'));
    if (!$result){
        return redirect()->back()->withInput($request->only('email', 'remember_me'))
            ->withErrors(['error'=>'credendiales incorrectas']);
    }

    return redirect(RouteServiceProvider::ADMIN_HOME);


    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login.show');
    }



    private function rules()
    {
        return [
            'email'=>'required|email',
            'password'=>'required|min:4',
            'remember_me'=>'in:on,off'
        ];
    }
}
