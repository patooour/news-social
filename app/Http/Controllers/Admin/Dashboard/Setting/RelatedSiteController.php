<?php

namespace App\Http\Controllers\Admin\Dashboard\setting;

use App\Http\Controllers\Controller;
use App\Models\RelatedSite;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Http\Request;

class RelatedSiteController extends Controller
{

    public function index()
    {
        $related_site = RelatedSite::latest()->paginate(8);
        return view('dashboard.relatedSite.index' , compact('related_site'));
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
    public function store(Request $request)
    {
        $request -> validate(RelatedSite::filterRequest());

       $related_site = RelatedSite::create($request->except('_token'));
        Flasher::addSuccess('relatedSite: ' . $related_site->name . ' created successfully');
        return redirect()->route('admin.relatedSite.index');
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

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request -> validate(RelatedSite::filterRequest());
        $related_site = RelatedSite::findorfail($id);

        $related_site_after = $related_site->update($request->except('_token'));
        if (!$related_site_after){
            Flasher::addError('Try again later');
            return redirect()->route('admin.relatedSite.index');
        }

        Flasher::addSuccess('relatedSite  update successfully');
        return redirect()->route('admin.relatedSite.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $relatedSite = RelatedSite::findorfail($id);
        $relatedSite->delete();
        Flasher::addSuccess('relatedSite: ' . $relatedSite->name . ' deleted successfully');
        return redirect()->route('admin.relatedSite.index');
    }
}
