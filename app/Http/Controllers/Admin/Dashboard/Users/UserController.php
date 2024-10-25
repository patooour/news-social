<?php

namespace App\Http\Controllers\Admin\Dashboard\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\UserRequest;
use App\Models\Image;
use App\Models\User;
use App\Utils\imageManager;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:users');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sort_by = request('sort_by') ?? 'id';
        $order_by = request('order_by') ?? 'DESC';
        //search condition by when(condition , clogure function)
        $users = User::when(request()->search, function ($query) {
            $query->where('name', 'like', '%' . request()->search . '%')
                ->orWhere('email', 'like', '%' . request()->search . '%');
        })->when(request()->status, function ($query) {
            $query->where('status', '=',  request()->status == 'active' ? 1 : 0 );
        })->orderBy(  $sort_by , $order_by)
        ->paginate(request('limit_by' , 10));
        return view('dashboard.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        try {
            DB::beginTransaction();
            $request->validated();
            $request->merge([
                'email_verified_at'=> $request->get('email_verified_at') == 1 ? now() : null,
            ]);
            $user = User::create($request->except(['_token' , 'image' ,'password_confirmation']));
            imageManager::checkImageToUpload($request , $user ,'uploads/users');
            DB::commit();

        }catch (\Exception $exception){
            DB::rollBack();
            return redirect()->back()->with('error' , $exception->getMessage());
        }

        Flasher::addSuccess('user: '. $user->name . 'added successfully');
        return redirect()->route('admin.users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user =  User::findorfail($id);
        return view('dashboard.users.show', compact('user'));
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

       $user =  User::findorfail($id);

            //delete image from locale

       imageManager::deleteImageFromLocale($user->image);
       $user->delete();
       Flasher::addSuccess('user: '. $user->name .' deleted successfully');
       return redirect()->route('admin.users.index');
    }

    public function changeStatus($id)
    {
        $user =  User::findorfail($id);
        if ($user->status == 1) {
            $user->update([
                'status' => 0
            ]);
            Flasher::addSuccess('user: '. $user->name .' blocked successfully');

        }else{
            $user->update([
                'status' => 1
            ]);
            Flasher::addSuccess('user: '. $user->name .' active successfully');

        }

        return redirect()->back();
    }
}
