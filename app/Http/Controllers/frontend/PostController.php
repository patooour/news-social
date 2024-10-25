<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use App\Notifications\NewCommentNotify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function ShowSinglePost($slug)
    {
        $mainPost = Post::active()->with(['comments'=> function ($q) {
            $q -> latest()-> limit(3);
        }])->
        whereSlug($slug)
        ->firstOrFail();

         $category = $mainPost->category ;

        $category_posts = $category->posts()->active()
            ->select('id','title','slug')
            ->latest()
            ->limit(5)
            ->get();

        $mainPost->increment('num_of_views');


        return view('fronted.show-posts', compact('mainPost','category_posts'));
    }

    public function getAllComment($slug)
    {
        $post = Post::active()->whereSlug($slug)->firstOrFail();
        $comments = $post->comments()->with('user')->latest()->get();

      return response()->json(
          [ 'status'=>200,
            'data'=>$comments,
            'msg'=>'success',

          ]);

    }

    public function storeComment(Request $request)
    {

        $rules = [
          'comment' => 'required|string|max:255|min:5',
          'post_id' => 'required',
          'user_id' => 'required|exists:users,id',
        ];
        $validator = Validator::make($request->all() , $rules);

        if ($validator->fails()) {
            return response()->json([
                'status'=>400,
                'data'=>null,
                'msg'=>$validator->errors()->all(),
            ], 400);
        }
            $ip = $request->ip();
        $comment = Comment::create([
            'comment'     =>request('comment'),
            'user_id'     =>Auth::user()->id,
            'post_id'     =>request('post_id'),
            'ip_address'  =>$ip,
        ]);

        $post = Post::findorfail(request('post_id'));
            /// test
        if (Auth::user()->id != $post->user_id) {
            $post->user->Notify(new NewCommentNotify($comment, $post));
        }


        $comment = $comment->load('user');

        if (!$comment){
            return response()->json([
                'status'=>403,
                'data'=>null,
                'msg'=>'operation failed',
            ],403);
        }

        return response()->json([
            'status'=>201,
            'data'=>$comment,
            'msg'=>'comment  store successfully',
        ],201);
    }
}
