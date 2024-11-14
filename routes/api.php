<?php

use App\Http\Controllers\Api\Account\NotificationController;
use App\Http\Controllers\Api\Account\PostController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\Password\ForgetPasswordController;
use App\Http\Controllers\Api\Auth\Password\ResetPasswordController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\VerifyEmailController;
use App\Http\Controllers\Api\Frontend\CategoryController;
use App\Http\Controllers\Api\Frontend\ContactController;
use App\Http\Controllers\Api\Frontend\GeneralController;
use App\Http\Controllers\Api\Frontend\SettingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

###################################### register #####################################
Route::post('auth/Register',[RegisterController::class , 'Register']);


###################################### login #####################################

Route::controller(LoginController::class)->group(function () {
    Route::post('auth/login', 'login');
    Route::delete('auth/logout', 'logout')->middleware('auth:sanctum');
});

###################################### login #####################################

Route::controller(ForgetPasswordController::class)->group(function () {
    Route::post('auth/Password/sentOtp', 'passwordOtpSent');
});
Route::controller(ResetPasswordController::class)->group(function () {
    Route::post('auth/verify/reset', 'ResetPassword');
});

############################################ verify email #######################################
Route::controller(VerifyEmailController::class) ->middleware(['auth:sanctum' ])->group(function () {
    Route::post('auth/VerifyEmail', 'VerifyEmail');
    Route::get('auth/VerifyEmail/sendAgain', 'sendOtpAgain');
});

Route::middleware(['auth:sanctum', 'CheckUserStatus','CheckEmailVerify'])->prefix('account')->group(function (){
    Route::get('/user', function (Request $request) {
        return \App\Http\Resources\User\UserResource::make($request->user());
});

    Route::controller(\App\Http\Controllers\Api\Account\SettingController::class)->group(function(){
        Route::put('setting' , 'updateSetting');
        Route::put('setting/change-password' , 'changePassword');
    });
    Route::controller(PostController::class)->prefix('posts')->group(function(){
        Route::get('/' , 'getPosts');
        Route::post('/store' , 'storePost');
        Route::PUT('/update/{post_id}' , 'updatePost');
        Route::delete('/destroy/{post_id}' , 'destroy');
        Route::get('/comment/{post_id}' , 'getComment');
        Route::post('/comment/store' , 'storeComment');
    });

    Route::get('/notifications' ,[NotificationController::class , 'getNotifications']);
    Route::get('/notification/get/{id}' ,[NotificationController::class , 'readNotification']);
});

#################### Home page route ##########################################

Route::controller(GeneralController::class)->group(function () {
    Route::get('posts/{keyword?}','getPosts');
    Route::post('posts/search/{keyword?}', 'getPostsSearch');
    Route::get('posts/show/{slug}', 'showPost')->name('api.posts.show');
    Route::get('posts/comments/{slug}', 'showComments');
});

Route::get('categories',[CategoryController::class , 'getCategories']);
Route::get('categories/{slug}/posts',[CategoryController::class , 'getCategoryPosts']);

####################### Contact us ####################################
Route::post('contact/store',[ContactController::class , 'storeContact']) ->middleware('throttle:contact');

Route::get('settings',[SettingController::class , 'getSettings']);

