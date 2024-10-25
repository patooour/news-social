<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\frontend\ContactRequest;
use App\Models\Admin;
use App\Models\Contact;
use App\Notifications\NewContactNotify;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class ContactUsController extends Controller
{
    public function getContactUs(){
        return view('fronted.contact-us');
    }

    public function ContactStore(ContactRequest $request){


        $request->validated();

        $request->merge([
            'ip_address'=>$request->ip()
        ]);
       $contact = Contact::create($request->all());

       $admins = Admin::get();
        Notification::send($admins, new NewContactNotify($contact));

       if (!$contact){
           Flasher::addError('try again later or contact admin');
           return redirect()->back();
       }


        Flasher::addSuccess('your message has been sent');
        return redirect()->back();


    }
}
