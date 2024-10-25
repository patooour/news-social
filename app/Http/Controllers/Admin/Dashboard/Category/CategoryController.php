<?php

namespace App\Http\Controllers\Admin\Dashboard\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\CategoryRequest;
use App\Models\Category;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:categories');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sort_by = request('sort_by') ?? 'id';
        $order_by = request('order_by') ?? 'DESC';
        //search condition by when(condition , clogure function)
        $categories = Category::withCount('posts')->when(request()->search, function ($query) {
            $query->where('name', 'like', '%' . request()->search . '%')
                ->orWhere('slug', 'like', '%' . request()->search . '%');
        })->when(request()->status, function ($query) {
            $query->where('status', '=',  request()->status == 'active' ? 1 : 0 );
        })->orderBy(  $sort_by , $order_by)
            ->paginate(request('limit_by' , 10));

        return view('dashboard.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $request->validated();
        $category = Category::create($request->except('_token'));
        if (!$category){
            Flasher::addError('try again later');
            return redirect()->route('admin.categories.index');
        }
        Flasher::addSuccess('category: '.$category->name . 'created successfully');
        return redirect()->route('admin.categories.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        $Category =  Category::findorfail($id);
        $Category->slug = null;
        $Category = $Category->update($request->except('_token','_method'));
        if (!$Category){
            Flasher::addError('try again later');
            return redirect()->route('admin.categories.index');
        }
        Flasher::addSuccess('category updated successfully');
        return redirect()->route('admin.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $Category =  Category::findorfail($id);

        $Category->delete();

        Flasher::addSuccess('Category: '. $Category->name .' deleted successfully');
        return redirect()->route('admin.categories.index');
    }
    public function changeStatus($id)
    {
        $cateogry =  Category::findorfail($id);
        if ($cateogry->status == 1) {
            $cateogry->update([
                'status' => 0
            ]);
            Flasher::addSuccess('cateogry: '. $cateogry->name .' blocked successfully');

        }else{
            $cateogry->update([
                'status' => 1
            ]);
            Flasher::addSuccess('cateogry: '. $cateogry->name .' active successfully');

        }

        return redirect()->back();
    }
}
