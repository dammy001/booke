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

    Route::get('profile', 'UserAPIController@details')->name('profile');
    Route::post('logout', 'UserAPIController@logout')->name('logout');
    Route::post('profile/update-name', 'UserAPIController@updateName')->name('profile.update_name');
    Route::post('profile/update-phone', 'UserAPIController@updatePhone')->name('profile.update_phone');

    Route::get('category', 'CategoryAPIController@index')->name('category');
    Route::get('category/{id}', 'CategoryAPIController@show')->name('category.show');

    Route::get('book', 'BookAPIController@index')->name('book');
    Route::get('just-in', 'BookAPIController@justIn')->name('justin');
    Route::get('popular', 'BookAPIController@popular')->name('popular');

    Route::get('book/{id}', 'BookAPIController@show')->name('book.show');

    Route::post('library', 'LibraryController@save')->name('library.save');
    Route::get('library', 'LibraryController@library')->name('library');
    Route::get('library/delete/{id}', 'LibraryController@deleteLibrary')->name('library.delete');

    Route::post('comment', 'CommentAPIController@save')->name('comment.save');
    Route::get('comment/{id}', 'CommentAPIController@comments')->name('comment');
});


Route::resource('ratings', 'RatingAPIController');
