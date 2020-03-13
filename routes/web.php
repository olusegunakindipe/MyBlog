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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' =>'admin', 'middleware' => 'auth'], function(){

    Route::get('/home', 'HomeController@index')->name('home');
    
    Route::resource('/post', 'PostsController');

    // Route::get('/post/create', 'PostsController@create')->name('post.create');
      
    // Route::post('/post/store', 'PostsController@store')->name('post.store');

    Route::resource('/category', 'CategoriesController');

    Route::get('/posts/trashed', 'PostsController@trashed')->name('post.trashed');
    Route::delete('/posts/kill/{post}', 'PostsController@kill')->name('post.kill');
    Route::get('/posts/restore/{post}', 'PostsController@restore')->name('post.restore');


    // Route::get('/category/create', 'CategoriesController@create')->name('category.create');

    // Route::get('/category/edit/{id}', 'CategoriesController@edit')->name('category.edit');

    // Route::get('/category/delete/{id}', 'CategoriesController@destroy')->name('category.delete');

    // Route::post('/category/store', 'CategoriesController@store')->name('category.store');


});

