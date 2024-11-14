<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Resources\Category\CategoryCollection;
use App\Http\Resources\PostCollection;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getCategories(){
        $cats = Category::active()->get();
        if (!$cats){
            return apiSuccessResponse(404 , 'categories not found');
        }
        return apiSuccessResponse(200 , 'categories' ,new CategoryCollection($cats));
    }

    public function getCategoryPosts($slug){

        $cats = Category::active()->whereSlug($slug)->first();

        if (!$cats){
            return apiSuccessResponse(404 , 'categories not found');
        }
        $cats_posts = $cats->posts;
        return apiSuccessResponse(200 , 'posts of categories' ,new PostCollection($cats_posts) );
    }
}
