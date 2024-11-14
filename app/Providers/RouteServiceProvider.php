<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/';
    public const ADMIN_HOME = 'admin/home';


    public function boot(): void
    {
      $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            Route::middleware('web')
                ->group(base_path('routes/admin.php'));
        });
    }
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(3)->by($request->user()?->id ?: $request->ip())->response(function (){
                return apiSuccessResponse(429 , 'try again after 1 min');
            });

        });
        RateLimiter::for('contact', function (Request $request) {
            return Limit::perMinute(1)->by( $request->ip())->response(function (){
                return apiSuccessResponse(429 , 'try again after 1 min');
            });

        });
        RateLimiter::for('login', function (Request $request) {
            return Limit::perMinute(3)->by( $request->ip())->response(function (){
                return apiSuccessResponse(429 , 'try again after 1 min');
            });

        });
        RateLimiter::for('login-web', function (Request $request) {
            return Limit::perMinute(3)->by( $request->ip())->response(function (){
                abort(404);
            });

        });
    }
}
