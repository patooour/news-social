<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Flasher\Prime\Flasher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SearchController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $validator = Validator::make($request->all(), ['search' => 'required|min:2|max:100']);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $keyword = strip_tags($request->get('search'));
      $posts = Post::active()->where('title' , 'LIKE' , '%'.$keyword .'%')->
          orwhere('desc' , 'LIKE' , '%'.$keyword .'%')
          ->paginate(12);

      return view('fronted.search', compact('posts'));
    }
}
