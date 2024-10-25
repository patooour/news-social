<?php

namespace App\Http\Controllers\Admin\Dashboard\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Image;
use App\Models\Post;
use App\Utils\imageManager;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:posts');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sort_by = request('sort_by') ?? 'id';
        $order_by = request('order_by') ?? 'DESC';
        //search condition by when(condition , clogure function)
        $posts = Post::when(request()->search, function ($query) {
            $query->where('title', 'like', '%' . request()->search . '%');
        })->when(request()->status, function ($query) {
            $query->where('status', '=', request()->status == 'active' ? 1 : 0);
        })->orderBy($sort_by, $order_by)
            ->paginate(request('limit_by', 10));
        return view('dashboard.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('dashboard.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        try {
            DB::beginTransaction();
            $request->validated();
            $this->commentAble($request);
            $post =Auth::guard('admin')->user()->posts()
                ->create($request->except('_token', 'image'));

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
            imageManager::uploadImages($request, $post);
            DB::commit();
            Cache::forget('latest_posts');
            Cache::forget('read_posts');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $exception->getMessage()]);
        }

        Flasher::addSuccess('post created successfully');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $post = Post::findorfail($id);
        $categories = Category::all();
        return view('dashboard.posts.show', compact('post','categories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
       $post = Post::findorfail($id);
       return view('dashboard.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, string $id)
    {
        $request->validated();
        try {
            DB::beginTransaction();
            $post = Post::findorfail($id);
            $this->commentAble($request);
            $post->slug = null;
            $post->update($request->except('_token', 'image','_method'));

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
        return redirect()->route('admin.posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findorfail($id);
        //delete image from locale
        imageManager::deleteImagefromLocaleAndDb($post);
        $post->delete();
        Flasher::addSuccess('Post: ' . $post->title . ' deleted successfully');
        return redirect()->route('admin.posts.index');
    }

    public function changeStatus($id)
    {
        $post = Post::findorfail($id);
        if ($post->status == 1) {
            $post->update([
                'status' => 0
            ]);
            Flasher::addSuccess('post: ' . $post->name . ' blocked successfully');

        } else {
            $post->update([
                'status' => 1
            ]);
            Flasher::addSuccess('post: ' . $post->name . ' active successfully');
        }
        return redirect()->back();
    }
    private function commentAble($request)
    {
        return $request->comment_able == "on" ? $request->merge(['comment_able' => 1])
            : $request->merge(['comment_able' => 0]);

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

    public function deleteComment($id)
    {
        $comment = Comment::findorfail($id);
        if (!$comment){
            return response()->json([
                'status'=>403,
                'msg'=>'comment not found',
                'data'=>null
            ]);
        }
        $comment->delete();
        return response()->json([
            'status'=>200,
            'msg'=>'comment deleted success',
            'data'=>$comment->id
        ]);
    }
}
