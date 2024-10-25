<?php

namespace App\Http\Controllers\Admin\Dashboard\Contact;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(){

        $sort_by = request('sort_by') ?? 'id';
        $order_by = request('order_by') ?? 'ASC';
        //search condition by when(condition , clogure function)
        $contacts = Contact::when(request()->search, function ($query) {
            $query->where('title', 'like', '%' . request()->search . '%');
            $query->where('name', 'like', '%' . request()->search . '%');
            $query->where('email', 'like', '%' . request()->search . '%');
        })->when(request()->status, function ($query) {
            $query->where('status', '=', request()->status == 'active' ? 1 : 0);
        })->orderBy($sort_by, $order_by)
            ->paginate(request('limit_by', 10));

        return view('dashboard.contacts.index' , compact('contacts') );
    }

    public function show($id){
        $contact = Contact::findorfail($id);
        $contact->status = 1;
        $contact->save();
        return view('dashboard.contacts.show' , compact('contact') );

    }

    public function destroy($id){
        $contact = Contact::findorfail($id);
        $contact->delete();
        Flasher::addSuccess('Contact Deleted Successfully');
        return redirect()->route('admin.contacts.index');
    }
}
