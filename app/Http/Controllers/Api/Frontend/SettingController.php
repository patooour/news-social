<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Resources\RelatedNews\RelatedNewsCollection;
use App\Http\Resources\Setting\SettingResource;
use App\Models\RelatedSite;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function getSettings()
    {
        $settings = Setting::all();
        $related_sites = RelatedSite::all();


        if (!$settings){
            return apiSuccessResponse(404 , 'settings not found');
        }

        return apiSuccessResponse(200 , 'success', [
            'settings' => SettingResource::collection($settings) ,
            'related sites' =>  new RelatedNewsCollection($related_sites)
          ]);
    }
}
