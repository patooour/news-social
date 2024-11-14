<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Resources\Category\CategoryCollection;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Comment\CommentCollection;
use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    public function getPosts(){

        $query  = Post::query()->active()->with(['category' , 'user' , 'images','admin','comments'])
            ->activeUser()->activeCategory();

        if (\request()->query('keyword')){
            $query->where('title' , 'like' , '%' . \request()->query('keyword') . '%');
        }

        $posts = clone $query->paginate(5);

        $latest_post      =      $this->latest_post(clone $query);
        $top_category     =      $this->top_category();
        $most_view_posts  =      $this->most_view_posts(clone $query);

        return apiSuccessResponse(200 , 'posts', [
            'all_posts'=>(new PostCollection($posts))->response()->getData(true),
            'latest_posts'=>(new PostCollection($latest_post)) ,
            'top_category'=>(new CategoryCollection($top_category))  ,
            'most_view_posts'=>(new PostCollection($most_view_posts))
        ]);
    }

    public function latest_post($query){
         $latest_post = $query->latest()->take(3)->get();
        if (!$latest_post){
            return apiSuccessResponse(404 , 'no latest post found');
        }
        return  $latest_post;
    }
    public function most_view_posts($query){
       $most_view_posts =  $query->with('images')
            ->orderBy('num_of_views','DESC')
            ->limit(3)
            ->get();

        if (!$most_view_posts){
            return apiSuccessResponse(404 , 'no most view posts found');
        }
       return $most_view_posts;
    }

    public function top_category(){
        $categories = Category::get();
        $top_category = $categories->map(function($q){
            $q->posts = $q->posts()->active()->limit(3)->get();
            return $q;
        });
        if (!$top_category){
            return apiSuccessResponse(404 , 'no categories found');
        }
        return $top_category;

    }
    public function showPost($slug){
        $post  = Post::with(['category' , 'user' , 'images','admin' ,'comments'])
            ->active()->activeUser()->activeCategory()->whereSlug($slug)->first();

        if (!$post){
            return apiSuccessResponse(404 , 'no posts found');
        }
        return apiSuccessResponse(200 , 'posts', [
            'post'=> new PostResource($post),

        ]);

    }
    public function showComments($slug)
    {
        $post  = Post::active()->activeUser()->activeCategory()->whereSlug($slug)->first();

        if (!$post){
            return apiSuccessResponse(404 , 'no posts found');
        }
        $post_comment =  $post->comments;
        if (!$post_comment){
            return apiSuccessResponse(404 , 'no comments found');
        }
        return apiSuccessResponse(200 , 'comments', new CommentCollection($post_comment));

    }

    public function getPostsSearch(Request $request)
    {
        $query  = Post::query()->active()->with(['category' , 'user' , 'images','admin','comments'])
            ->activeUser()->activeCategory();

        if ($request->keyword){
            $query->where('title' , 'like' , '%' . $request->keyword . '%');
        }
        $posts = clone $query->paginate(15);
        if (!$posts){
            return apiSuccessResponse(404 , 'no posts found');
        }
        return apiSuccessResponse(200 , 'posts', new PostCollection($posts));


    }
}
