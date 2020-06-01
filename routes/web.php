<?php

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

Route::get('/', function () {
    return view('welcome');
});


Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->middleware(['verified']);

Route::middleware(['verified'])->group(function() {
    Route::group(['middleware' => ['isAdmin']], function () {
        Route::group(['prefix' => 'admin'], function () {
            Route::resource('books', 'Admin\BookController', ["as" => 'admin']);
            Route::resource('categories', 'Admin\CategoryController', ["as" => 'admin']);
            Route::resource('users', 'Admin\UserController', ["as" => 'admin']);
        });
    });
});
