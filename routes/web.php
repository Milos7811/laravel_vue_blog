<?php

use App\Http\Middleware\UserProfile;
use App\Http\Middleware\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\CommentController;

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
//auth
Auth::routes(['verify' => true]);
Route::get('auth/{service}', 'Auth\LoginController@redirectToProvider')
    ->where('service', '(github|google|facebook)');
Route::get('auth/{service}/callback', 'Auth\LoginController@handleProviderCallback')
    ->where('service', '(github|google|facebook)');


Route::get('/', 'HomeController@index')->name('home');
Route::get('/about', 'PagesController@about');
Route::resource('posts', 'PostController');
Route::resource('users', 'UserController')->middleware('auth');
Route::resource('tag', 'TagController');
Route::resource('images', 'PostImageController');
Route::post('/avatar', 'UserController@update_avatar');


Route::resource('comments', 'CommentController')->only([
    'store', 'update', 'destroy'
]);

//API -ADMIN

Route::get('/admin/{any?}', function () {
    return view('layouts.admin');
})->where('any', '.*')->middleware('auth', 'admin');
