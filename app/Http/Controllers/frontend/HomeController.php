<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\RelatedSite;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){

        $posts =  Post::active()->with('images')
            ->latest()
           ->paginate(9);

        $most_view_posts = Post::active()->with('images')
            ->orderBy('num_of_views','DESC')
            ->limit(3)
            ->get();

        $oldest_posts = Post::active()->with('images')
            ->oldest()
            ->take(3)
            ->get();

        $great_posts_comment = Post::active()->withCount('comments')
            ->orderBy('comments_count','DESC')
            ->limit(3)
            ->get();

            $category = Category::active()->get();
            $top_category = $category->map(function($q){
                $q->posts = $q->posts()->active()->limit(4)->get();
                return $q;
            });



        return view('fronted.index',[
            'posts' => $posts,
            'most_view_posts' => $most_view_posts,
            'oldest_posts' => $oldest_posts,
            'great_posts_comment'=>$great_posts_comment,
            'top_category'=>$top_category,

        ]);

    }
}
