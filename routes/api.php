<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', 'UserAPIController@register')->name('register');
Route::post('login', 'UserAPIController@login')->name('login');

Route::group(['middleware' => 'auth:api'], function(){

    Route::post('profile', 'UserAPIController@details')->name('profile');
    Route::post('logout', 'UserAPIController@logout')->name('logout');
    Route::post('profile/update-name', 'UserAPIController@updateName')->name('profile.update_name');

    Route::get('category', 'CategoryAPIController@index')->name('category');
    Route::get('category/{id}', 'CategoryAPIController@show')->name('category.show');

    Route::get('book', 'BookAPIController@index')->name('book');
    Route::get('just-in', 'BookAPIController@justIn')->name('justin');
    Route::get('book/{id}', 'BookAPIController@show')->name('book.show');
});
