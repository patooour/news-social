<?php

namespace App\Http\Controllers\Admin\Dashboard\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\settingRequest;
use App\Models\Setting;
use App\Utils\imageManager;
use Flasher\Prime\Flasher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:settings');
    }
    public function index(){
        return view('dashboard.settings.index');
    }

    public function update(settingRequest $request){
        $request->validated();

        try {
            DB::beginTransaction();
            $setting = Setting::findorfail($request->setting_id);
            $setting->update($request->except('_token','logo','favicon'));

            if ($request->hasFile('logo')) {
                imageManager::deleteImageFromLocale($setting->logo);
                $path = imageManager::uploadImageToSetting($request,$setting->name , 'uploads/settings' , 'logo') ;
                $setting->update([
                    'logo' => $path
                ]);
            }
            if ($request->hasFile('favicon')) {
                imageManager::deleteImageFromLocale($setting->favicon);
                $path = imageManager::uploadImageToSetting($request,$setting->name , 'uploads/settings' , 'favicon') ;
                $setting->update([
                    'favicon' => $path
                ]);
            }
            DB::commit();
        }catch (\Exception $e){
            DB::commit();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

        \Flasher\Laravel\Facade\Flasher::addSuccess('Settings Updated Successfully');
        return redirect()->back();
    }
}
