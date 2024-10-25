<?php

namespace App\Http\Controllers\Admin\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\AdminRequest;
use App\Models\Admin;
use App\Models\Authorization;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:admins');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sort_by = request('sort_by') ?? 'id';
        $order_by = request('order_by') ?? 'DESC';
        //search condition by when(condition , clogure function)
        $admins = Admin::where('id' , '!=' ,Auth::guard('admin')->user()->id)->when(request()->search, function ($query) {
            $query->where('name', 'like', '%' . request()->search . '%')->
            orWhere('email', 'like', '%' . request()->search . '%')->
            orWhere('username', 'like', '%' . request()->search . '%');
        })->when(request()->status, function ($query) {
            $query->where('status', '=', request()->status == 'active' ? 1 : 0);
        })->orderBy($sort_by, $order_by)
            ->paginate(request('limit_by', 10));
        return view('dashboard.admins.index' , compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Authorization::all();
        return view('dashboard.admins.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminRequest $request)
    {

        $request->validated();
        $request->merge([
           'password'=>bcrypt($request->password)
        ]);
        $admin = Admin::create($request->except('_token'));
        if (!$admin){
            return redirect()->back()->withErrors('try again later');
        }
        Flasher::addSuccess('admin: ' . $admin->name  .' created successfully');
        return redirect()->route('admin.admins.index');
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
        $roles = Authorization::all();
        $admin = Admin::findorfail($id);
        return view('dashboard.admins.edit', compact('admin' , 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminRequest $request, string $id)
    {
        $request->validated();
        $request->merge([
            'password'=>bcrypt($request->password)
        ]);
        $admin = Admin::findorfail($id);
        $admin = $admin->update($request->except('_token'));
        if (!$admin){
            return redirect()->back()->withErrors('try again later');
        }
        Flasher::addSuccess('admin updated successfully');
        return redirect()->route('admin.admins.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $admin = Admin::findorfail($id);
        $admin->delete();
        Flasher::addSuccess('Admin: ' . $admin->name . ' deleted successfully');
        return redirect()->route('admin.admins.index');
    }
    public function changeStatus($id)
    {

        $admin =  Admin::findorfail($id);

        if ($admin->status == 1) {
            $admin->update([
                'status' => 0
            ]);
            Flasher::addSuccess('user: '. $admin->name .' blocked successfully');

        }else{
            $admin->update([
                'status' => 1
            ]);
            Flasher::addSuccess('user: '. $admin->name .' active successfully');

        }

        return redirect()->back();
    }
}
