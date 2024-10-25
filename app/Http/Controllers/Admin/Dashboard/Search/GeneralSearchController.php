<?php

namespace App\Http\Controllers\Admin\Dashboard\Search;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class GeneralSearchController extends Controller
{
    public function search(Request $request)
    {
        if ($request->options == "users"){
           $users =  User::where('name' , 'LIKE' , '%'.$request->search.'%')
                ->orwhere('email' , 'LIKE' , '%'.$request->search.'%')
                ->orwhere('username' , 'LIKE' , '%'.$request->search.'%')->paginate(5);
            return view('dashboard.users.index', compact('users'));

        }elseif ($request->options == "posts"){
            $posts = Post::where('title' , 'LIKE' , '%'.$request->search.'%')
                ->orwhere('desc' , 'LIKE' , '%'.$request->search.'%')
               ->paginate(5);
            return view('dashboard.posts.index', compact('posts'));

        }elseif ($request->options == "contacts"){
            $contacts = Contact::where('name' , 'LIKE' , '%'.$request->search.'%')
                ->orwhere('email' , 'LIKE' , '%'.$request->search.'%')
                ->orwhere('body' , 'LIKE' , '%'.$request->search.'%')
                ->paginate(5);
            return view('dashboard.contacts.index', compact('contacts'));

        }elseif ($request->options == "categories"){
            $categories =  Category::where('name' , 'LIKE' , '%'.$request->search.'%')
                ->orwhere('small_desc' , 'LIKE' , '%'.$request->search.'%')
                ->paginate(5);
            return view('dashboard.categories.index', compact('categories'));
        }else{
            return redirect()->back();
        }


    }
}
