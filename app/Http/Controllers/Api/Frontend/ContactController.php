<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\frontend\ContactRequest;
use App\Models\Admin;
use App\Models\Contact;
use App\Notifications\NewContactNotify;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class ContactController extends Controller
{
    public function storeContact(ContactRequest $request)
    {

        $request->validated();
        $request->merge([
            'ip_address'=>$request->ip()
        ]);
        $contact = Contact::create($request->all());
        if (!$contact){
           return apiSuccessResponse('400' , 'try again later');
        }
        $admins = Admin::get();
        Notification::send($admins, new NewContactNotify($contact));

        return apiSuccessResponse('201' , 'contact added successfully');

    }
}
