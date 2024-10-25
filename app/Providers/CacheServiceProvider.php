<?php

namespace App\Providers;

use App\Models\Post;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class CacheServiceProvider extends ServiceProvider
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
        if (!Cache::has('read_posts')){
            $read_posts = Post::active()->select('id','title','slug')->latest()->limit(10)->get();
            Cache::remember('read_posts',3000, function () use($read_posts){
                return $read_posts;
            });

        }

        if (!Cache::has('latest_posts')) {
            $latest_posts = Post::active()->select('id', 'title', 'slug')->latest()->limit(5)->get();
            Cache::remember('latest_posts', 3000, function () use ($latest_posts) {
                return $latest_posts;
            });
        }
        $latest_posts = Cache::get('latest_posts');

        if (!Cache::has('great_posts_comment')) {
            $great_posts_comment = Post::active()->withCount('comments')
                ->orderBy('comments_count','DESC')
                ->limit(5)
                ->get();

            Cache::remember('great_posts_comment', 3000, function () use ($great_posts_comment) {
                return $great_posts_comment;
            });
        }
        $great_posts_comment = Cache::get('great_posts_comment');
        $read_posts = Cache::get('read_posts');
        view()->share([
            'read_posts'=> $read_posts,
            'latest_posts' => $latest_posts,
            'great_posts_comment' => $great_posts_comment,
        ]);
    }
}
