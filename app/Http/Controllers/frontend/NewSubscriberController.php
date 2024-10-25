<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Mail\frontend\NewSubscriberMail;
use App\Models\newSubscriber;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class NewSubscriberController extends Controller
{


    public function subscriber(Request $request){


        $rules =
            [
                'email'=>'required|email|unique:new_subscribers,email'
            ];

        $validator = Validator::make($request->all(),$rules);

        if($validator->fails()){
/*            Session::flash('error' , 'try again later or contact admin');*/
            Flasher::addError('try again later or contact admin');

            return redirect()->back()->withErrors($validator)->withInput();
             }

        $newSubscriber = new newSubscriber();
        $newSubscriber->email = $request->input('email');
        $newSubscriber->save();

        Mail::to($request->get('email'))->send(new NewSubscriberMail());
/*        Session::flash('Success' , '');*/
        Flasher::addSuccess('you have successfully subscribed');
        return redirect()->back();
    }
}
