<?php

namespace App\Http\Controllers\Api\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Http\Resources\Comment\CommentCollection;
use App\Http\Resources\Comment\CommentResource;
use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
use App\Models\Comment;
use App\Models\Image;
use App\Models\Post;
use App\Notifications\NewCommentNotify;
use App\Utils\imageManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function getPosts(){
        $user = Auth::guard('sanctum')->user();
        if (!$user){
            return apiSuccessResponse(404 , 'user not found');
        }
        $posts = $user->posts()->active()->activeCategory()->get();
       if ($posts->count() > 0){
           return apiSuccessResponse(200 ,'this is posts of user', [
               new PostCollection($posts)
           ]);
       }
        return apiSuccessResponse(404 ,'no posts found');

    }

    public function storePost(PostRequest $request){

        try {

            DB::beginTransaction();
            $request->validated();
            if (RateLimiter::tooManyAttempts($request->ip(), 2)) {
                $time = RateLimiter::availableIn($request->ip());
                return apiSuccessResponse(429 , 'try again after :'.$time);
            }
            RateLimiter::increment($request->ip());
            $remain = RateLimiter::remaining($request->ip() , 2);
            $request->merge(['user_id' => Auth::guard('sanctum')->user()->id]);
            $post = Post::create($request->except('image'));
            imageManager::uploadImages($request , $post);
            DB::commit();
            Cache::forget('latest_posts');
            Cache::forget('read_posts');

        }catch (\Exception $exception){
            DB::rollBack();
            Log::error('error store user post');
            return apiSuccessResponse(500 , $exception->getMessage());
        }
        return apiSuccessResponse(200 , 'post created successfully' ,[
           'post' => new PostResource($post),
            'Remaining'=> $remain
        ] );

    }

    public function destroy($post_id){
        //delete post of user
        $user = auth('sanctum')->user();
        $post = $user->posts()->find($post_id);

        if (!$post){
            return apiSuccessResponse(404 , 'post not found');
        }
        imageManager::deleteImage($post);
        $post->delete();
        return apiSuccessResponse(200 , 'post deleted successfully');

    }

    public function getComment($post_id)
    {
        $user = auth('sanctum')->user();
        $post = $user->posts()->find($post_id);
        if (!$post){
            return apiSuccessResponse(404 , 'post not found');
        }
        $comment = $post->comments;
        if ($comment->count() > 0){
            return apiSuccessResponse(200 , 'post has comments' ,
                [new CommentCollection($comment)]);
        }
        return apiSuccessResponse(404 , 'no comments ' );

    }

    public function updatePost(PostRequest $request , $post_id)
    {
        try {
            DB::beginTransaction();
            $request->validated();
            $user = auth('sanctum')->user();
            $post = $user->posts()->find($post_id);
            if (!$post){
                return apiSuccessResponse(404 , 'post not found');
            }
            $post->update($request->except('_method', 'image'));

            if ($request->hasFile('image')) {
                //delete old images from locale in imageManager class
                imageManager::deleteImagefromLocaleAndDb($post);
                //upload image to locale and db
                imageManager::uploadImages($request , $post);
            }
            DB::commit();

        }catch (\Exception $exception){
            DB::rollBack();
            Log::error('error update user post' , $exception->getMessage() );
            return apiSuccessResponse(500 , $exception->getMessage());
        }
        return apiSuccessResponse(200 , 'post updated successfully' );


    }
    public function deleteImage(Request $request)
    {
        $image = Image::find($request->key);

        if (!$image){
            return response()->json([
                'status'=>201,
                'msg'=>'image not found',
            ]);
        }
        // delete image from locale
        imageManager::deleteImageFromLocale($image->path);
        $image->delete();
        return response()->json([
            'status'=>200,
            'msg'=>'image deleted successfully',
        ]);
    }
    public function storeComment(Request $request )
    {

        $request->validate([
            'comment' => 'required|string|max:255|min:5',
            'post_id' => 'required|exists:posts,id',
        ]);

        $post = Post::find(request('post_id'));
        if (!$post){
            return apiSuccessResponse(404 , 'post not found');
        }

       $comment = $post->comments()->create([
            'comment'     =>request('comment'),
            'user_id'     =>auth()->guard('sanctum')->user()->id,
            'ip_address'  =>$request->ip(),
        ]);


        /// test
        if (auth()->guard('sanctum')->user()->id != $post->user_id) {
            $post->user->Notify(new NewCommentNotify($comment, $post));
        }
        $comment = $comment->load('user');

        if (!$comment){
            return apiSuccessResponse(403 ,'operation failed' );

        }
        return apiSuccessResponse(201 ,'comment  store successfully' , $comment);
    }




}
