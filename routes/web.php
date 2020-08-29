<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('/')->group(function(){
    Route::get('/','PageController@index');
});
Auth::routes(['verify' => true]);

Route::resource('/contacts','ContactController');
Route::middleware('verified')->group(function (){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/search','SearchController')->name('search');
    Route::get('/favorites/isFavorited/{id}', 'FavoriteController@isFavorited');
    Route::get('/favorites/list', 'FavoriteController@list');

    Route::view('/banks','banks');

    Route::prefix('/users')->group(function(){
        Route::get('/readNotifications', 'UserController@readNotifications');
        Route::get('/all_notifications','UserController@all_notifications');
        Route::get('/notifications','UserController@notifications');
        Route::patch('/updatePersonalInformation','UserController@updatePersonalInformation')->name('users.update_personal');
        Route::get('/settings', 'UserController@settings')->name('users.settings');
        Route::get('/{user}','UserController@show')->name('users.show');
        Route::get('/{user}/deactivate', 'UserController@deactivate')->name('users.deactivate');
    });

    Route::prefix('messages')->group(function(){
        Route::post('/{chat}', 'MessageController@store');
        Route::get('/{chat}','MessageController@index');
    });

    Route::prefix('chats')->group(function(){
        Route::get('/chatResource/{chat}', 'ChatController@chatResource');
        Route::get('/{chat}', 'ChatController@show')->name('chats.show');
        Route::post('/{user}', 'ChatController@store')->name('chats.store');
        Route::get('/','ChatController@index')->name('chats.index');
    });

    Route::resource('/payment','PaymentController');
    Route::resource('/favorites','FavoriteController')->only('index','store','destroy');
});
