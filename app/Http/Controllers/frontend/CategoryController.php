<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($slug)
    {
        $category = Category::where('slug', $slug)->active()->first();

        $posts = $category->posts()->orderBy('created_at', 'desc')->paginate(9);


        return view('fronted.category-posts', compact('posts','category'));
    }
}
