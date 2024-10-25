<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\RelatedSite;
use App\Models\Setting;
use Illuminate\Support\ServiceProvider;

class CheckSettingProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
       $get_settings =  Setting::firstOr(function (){
           return Setting::create([
               'site_name'=>'news',
               'favicon'=>'img/logo.png',
               'logo'=>'default.png',
               'facebook'=>'facebook',
               'youtube'=>'youtube',
               'instagram'=>'instagram',
               'twitter'=>'twitter',
               'country'=>'Egypt',
               'city'=>'ElMahalla',
               'street'=>'st 25 moheb',
               'email'=>'news@gmail.com',
               'phone'=>'0212154154',
               'small_desc'=>'small_description',
           ]);
        });


        $get_settings->whatsapp = 'http://wa.me/' . $get_settings->phone;
        view()->share([
           'settings' => $get_settings,

       ]);
    }
}
