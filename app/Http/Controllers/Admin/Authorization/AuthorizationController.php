<?php

namespace App\Http\Controllers\Admin\Authorization;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\AuthorizationRequest;
use App\Models\Authorization;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Http\Request;

class AuthorizationController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:authorizations');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Authorization::all();
        return view('dashboard.authorizations.index' , compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.authorizations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AuthorizationRequest $request)
    {

        $request->validated();

        $auth = new Authorization();
        $this->Roles($request , $auth);

        Flasher::addSuccess('Role: '. $auth->role .' added successfully');
        return redirect()->back();
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
        $auth = Authorization::findorfail($id);
        return view('dashboard.authorizations.edit' , compact('auth'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AuthorizationRequest $request, string $id)
    {
        $request->validated();
        $auth = Authorization::findorfail($id);
        $this->Roles($request , $auth);

        Flasher::addSuccess('Role: '. $auth->role .' updated successfully');
        return redirect()->route('admin.authorizations.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $auth = Authorization::findorfail($id);
        if ($auth->admins->count() > 0) {
            Flasher::addError('please delete admins first');
           return redirect()->back();
        }
        $auth->delete();
        Flasher::addSuccess('Role : ' . $auth->role . ' deleted successfully');
        return redirect()->route('admin.authorizations.index');

    }

    private function Roles($request , $auth)
    {
        $auth->role = $request->role;
        $auth->permissions = json_encode($request->permissions);
        $auth->save();
    }
}
