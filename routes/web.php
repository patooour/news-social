<?php

use App\Http\Controllers\Auth\VerificationController;
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

Route::get('///////', function () {
    return view('fronted.dashboard.setting');
});

Route::redirect('/' ,'/home');



Route::group(['prefix' => '/',], function (){
Route::get('home',[\App\Http\Controllers\frontend\HomeController::class , 'index'])->name('fronted.index');
Route::get('category/{slug}',[\App\Http\Controllers\frontend\CategoryController::class, '__invoke' ])->name('fronted.category.posts');

Route::controller(\App\Http\Controllers\frontend\PostController::class)
    ->name('fronted.post.')->prefix('post/')->group(function (){
        Route::get('{slug}', 'ShowSinglePost' )->name('show');
        Route::get('comment/{slug}', 'getAllComment' )->middleware('auth')->name('comment.all');
        Route::post('comment/store', 'storeComment' )->middleware('auth')->name('comment.store');
    });

Route::post('new_subscriber',[\App\Http\Controllers\frontend\NewSubscriberController::class , 'subscriber'])->name('subscriber');

Route::controller(\App\Http\Controllers\frontend\ContactUsController::class)
    ->name('fronted.contactUs')->prefix('contact-us')->group(function (){

        Route::get('/', 'getContactUs' );
        Route::post('/store', 'ContactStore' )->name('.store');

        });

Route::group(['prefix' => 'dashboard/user/' ,'middleware'=>['auth:web','verified'],'as'=>'fronted.dashboard.'], function (){

    Route::controller(\App\Http\Controllers\frontend\dashboard\ProfileController::class)
        ->prefix('profile')->middleware('CheckUserStatus')
        ->name('profile')->group(function (){
        Route::get('',  'getProfile');
        Route::post('/post/store', 'storePost')->name('.store.post');
        Route::get('/post/comments/{id}', 'comments')->name('.comments');
        Route::get('/post/edit/{slug}', 'editPost')->name('.post.edit');
        Route::put('/post/update/{slug}', 'updatePost')->name('.post.update');
        Route::delete('/post/delete/{slug}', 'deletePost')->name('.post.delete');
        Route::post('/post/image/delete', 'deleteImage')->name('.image.delete');

    });

    Route::controller(\App\Http\Controllers\frontend\dashboard\SettingController::class)
        ->prefix('setting')
        ->name('setting')->group(function (){
        Route::get('/',  'getSetting');
        Route::post('/update',  'update')->name('.update');
        Route::post('/change-password',  'changePassword')->name('.password');

    });

    Route::controller(\App\Http\Controllers\frontend\dashboard\NotificationController::class)
        ->prefix('notification')
        ->name('notification')->group(function (){
            Route::get('',  'getNotification');
            Route::post('/delete',  'delete')->name('.delete');
            Route::get('/deleteAll',  'deleteAll')->name('.deleteAll');


        });



});
    Route::match(['get','post'],'search',[\App\Http\Controllers\frontend\SearchController::class , '__invoke'])->name('fronted.search');

});


Route::get('/wait', function () {
    return view('fronted.dashboard.common.wait');
})->name('fronted.wait');

// customize route verify laravel ui

Route::controller(VerificationController::class)
    ->prefix('email/')
    ->name('verification.')
    ->group(function (){

        Route::get('verify', [ 'show'])->name('notice');
        Route::get('verify/{id}/{hash}', ['verify'])->name('verify');
        Route::post('resend', ['resend'])->name('resend');
    });



// end customize route verify laravel ui
Auth::routes();


