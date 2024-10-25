<?php

namespace App\Http\Controllers\frontend\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Comment;
use App\Models\Image;
use App\Models\Post;
use App\Utils\imageManager;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProfileController extends Controller
{


    public function getProfile(){
        return view('fronted.dashboard.profile');
    }

    public function storePost(PostRequest $request){

        try {
            DB::beginTransaction();
            $request->validated();
            $this->commentAble($request);
            $post = Post::create($request->except('_token', 'image'));

/*            if ($request->hasFile('image')) {
                foreach ($request->file('image') as $image) {
                    $file = $image->getClientOriginalExtension();
                    $imageName = $post->slug . '_' .  str::uuid()  . '.' . $file;
                    $path = $image->storeAs('uploads/posts', $imageName, ['disk' => 'uploads']);

                    $post->images()->create([
                        'path' => $path
                    ]);

                }

            }*/

            imageManager::uploadImages($request , $post);
            DB::commit();
        }catch (\Exception $exception){
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $exception->getMessage()]);
        }

           Flasher::addSuccess('post created successfully');
           return redirect()->back();
    }

    public function editPost($slug)
    {
        $post = Post::with(['images'])->where('slug', $slug)->firstOrFail();
        if (!$post){
            abort(404);
        }

       return view('fronted.dashboard.edit-post', compact('post'));
    }

    public function updatePost(PostRequest $request){

        try {
            DB::beginTransaction();
            $request->validated();
            $post = Post::findorfail($request->post_id);
            $this->commentAble($request);
            $post->update($request->except('_token', 'image','_method','post_id'));

         if ($request->hasFile('image')) {
             //delete old images from locale in imageManager class
             imageManager::deleteImagefromLocaleAndDb($post);
             //upload image to locale and db
             imageManager::uploadImages($request , $post);

         }

            DB::commit();

        }catch (\Exception $exception){
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $exception->getMessage()]);
        }
        Flasher::addSuccess('post updated successfully');
        return redirect()->back();
    }

    public function deletePost(Request $request)
    {

        $post = Post::where('slug' , '=' , $request->slug)->first();
        if (!$post){
            Flasher::addError('try again later ');
           abort(404);
        }
        imageManager::deleteImage($post);
        $post->delete();

        Flasher::addSuccess('post deleted successfully');
        return redirect()->back();
    }
    public function comments($id)
    {
        $comments = Comment::with('user')->where('post_id', $id)->get();
        if (!$comments){
            return response()->json([
                'data' => null,
                'msg' => 'no data found',
            ]);
        }

        return response()->json([
            'data' => $comments,
            'msg' => 'contain comments',
        ]);
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

    private function commentAble($request)
    {
        return $request->comment_able == "on" ? $request->merge(['comment_able' => 1])
            : $request->merge(['comment_able' => 0]);

    }
}
