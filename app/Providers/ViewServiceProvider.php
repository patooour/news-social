<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Post;
use App\Models\RelatedSite;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
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



        $useful_Links = RelatedSite::select('name','url')->limit(5)->get();
        $categories = Category::select('id','name','slug')->active()->get();

        view()->share([

            'useful_Links' => $useful_Links,
            'categories' => $categories,

        ]);
    }
}
