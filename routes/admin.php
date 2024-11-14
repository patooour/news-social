<?php

use App\Http\Controllers\Admin\Auth\loginController;
use App\Http\Controllers\Admin\Auth\Password\ForgetPasswordController;
use App\Http\Controllers\Admin\Auth\Password\ResetPasswordController;
use App\Http\Controllers\Admin\Authorization\AuthorizationController;
use App\Http\Controllers\Admin\Dashboard\Admin\AdminController;
use App\Http\Controllers\Admin\Dashboard\Category\CategoryController;
use App\Http\Controllers\Admin\Dashboard\Contact\ContactController;
use App\Http\Controllers\Admin\Dashboard\Home\HomeController;
use App\Http\Controllers\Admin\Dashboard\Notification\NotificationController;
use App\Http\Controllers\Admin\Dashboard\Post\PostController;
use App\Http\Controllers\Admin\Dashboard\Profile\ProfileController;
use App\Http\Controllers\Admin\Dashboard\Search\GeneralSearchController;
use App\Http\Controllers\Admin\Dashboard\setting\RelatedSiteController;
use App\Http\Controllers\Admin\Dashboard\Setting\SettingController;
use App\Http\Controllers\Admin\Dashboard\Users\UserController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Middleware\CheckAdminStatus;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// auth routes
Route::get('/wait', function () {
    return view('dashboard.common.wait');
})->name('admin.wait');


Route::group(['prefix'=>'admin', 'as' => 'admin.'], function(){

    Route::fallback(function (){
        return response()->view('errors.404');
    });

    Route::controller(loginController::class)->group(function () {
        Route::get('Login',  'showLoginForm')->name('login.show');
        Route::post('Login/checkAuth', 'checkAuth')->name('login.check');
        Route::post('logout',  'logout')->name('logout');
    });

    Route::group(['prefix'=>'password', 'as' => 'password.'], function(){
        Route::controller(ForgetPasswordController::class)->group(function () {
            Route::get('email',   'showEmailForm')->name('email');
            Route::post('email', 'sendOTP')->name('email.otp');
            Route::get('verify/{email}', 'getConfirmView')->name('email.verify');
            Route::post('verify','verifyOtp')->name('verify.otp');
        });
        Route::controller(ResetPasswordController::class)->group(function () {

            Route::get('resetPassword/{email}',  'resetPassword')->name('resetPassword');
            Route::post('resetPassword', 'updatePassword')->name('update');
        });
    });

});




Route::group(['prefix'=>'admin' , 'middleware'=>['auth:admin' , 'CheckAdminStatus'] , 'as' => 'admin.'],
    function(){
        Route::get('home', [HomeController::class ,'index'])->name('home');


##################### General search Controller ##################################
        Route::get('search', [GeneralSearchController::class ,'search'])->name('search');

##################### Resource Controller ########################################
        Route::resource('authorizations' , AuthorizationController::class);
        Route::resource('relatedSite' , RelatedSiteController::class);
        Route::resource('users' , UserController::class);
        Route::resource('categories' , CategoryController::class);
        Route::resource('posts' , PostController::class);
        Route::resource('admins' , AdminController::class);

        Route::get('users/status/{id}' , [UserController::class ,'changeStatus'])->name('users.block');
        Route::get('categories/status/{id}' , [CategoryController::class ,'changeStatus'])->name('categories.block');
        Route::get('posts/status/{id}' , [PostController::class ,'changeStatus'])->name('posts.block');
        Route::get('posts/comment_delete/{id}' , [PostController::class ,'deleteComment'])->name('posts.comment.delete');
        Route::get('admins/status/{id}' , [AdminController::class ,'changeStatus'])->name('admins.block');
        Route::post('posts/image/delete', [PostController::class ,'deleteImage'])->name('posts.image.delete');

        ###################### setting controller ###################
        Route::controller(SettingController::class)->prefix('settings')->name('settings.')->group(function () {
            Route::get('/' , 'index')->name('index');
            Route::post('/' , 'update')->name('update');

        });



        Route::controller(ContactController::class)->prefix('contacts')->name('contacts.')->group(function () {
            Route::get('' , 'index')->name('index');
            Route::get('/contacts/{id}' , 'show')->name('show');
            Route::delete('/contacts/destroy/{id}' , 'destroy')->name('destroy');
        });

        ###################### Profile controller ###################
        Route::controller(ProfileController::class)->prefix('profile')->name('profile.')->group(function () {
            Route::get('/' , 'index')->name('index');
            Route::post('/{id}' , 'update')->name('update');
            Route::get('/otp/{email}' , 'sentOtp')->name('sentOtp');
            Route::post('/verify/otp' , 'verifyOtp')->name('verifyOtp');

        });

        ###################### Notifications controller ###################
        Route::controller(NotificationController::class)->prefix('notifications')->name('notifications.')->group(function () {
            Route::get('/' , 'index')->name('index');
            Route::get('/destroy/{id}' , 'destroy')->name('destroy');
            Route::get('/delete/All' , 'deleteAll')->name('delete.all');


        });

});
