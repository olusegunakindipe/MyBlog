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

Route::get('/', 'FrontendController@index')->name('index');
Route::get('/posts/{slug}', 'FrontendController@singlepost')->name('single');
Route::get('/results', 'FrontendController@result')->name('result');

Route::get('/categories/{category}', 'FrontendController@singleCategory')->name('single.category');
Route::get('/tags/{tag}', 'FrontendController@singleTag')->name('single.tag');


Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' =>'admin', 'middleware' => 'auth'], function(){

    Route::get('/home', 'HomeController@index')->name('home');
    
    Route::resource('/post', 'PostsController');

    
    Route::resource('/category', 'CategoriesController');
    Route::resource('/tag', 'TagsController');
    Route::resource('/user', 'UsersController');

    Route::get('/setting', 'SettingsController@index')->name('settings.setting');
    Route::post('/setting/update', 'SettingsController@update')->name('settings.update');

    Route::get('/user/profile/{user}', 'UsersController@edit')->name('user.profile.edit');;

    Route::get('/users/trashed', 'UsersController@trashed')->name('user.trashed');
    Route::get('/posts/trashed', 'PostsController@trashed')->name('post.trashed');
    Route::delete('/posts/kill/{post}', 'PostsController@kill')->name('post.kill');
    Route::delete('/users/kill/{post}', 'UsersController@kill')->name('user.kill');

    Route::get('/posts/restore/{post}', 'PostsController@restore')->name('post.restore');
    Route::get('/users/restore/{post}', 'UsersController@restore')->name('user.restore');


    Route::get('/users/admin/{user}', 'UsersController@admin')->name('user.admin');
    Route::get('/users/notadmin/{user}', 'UsersController@notAdmin')->name('user.notadmin');
});

