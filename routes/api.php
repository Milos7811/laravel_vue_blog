<?php

use App\Http\Middleware\Admin;
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

Route::middleware('auth:api', 'admin')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api', 'admin')->group(function () {
    Route::apiResources([
        'posts' => 'API\PostController',
        'comments' => 'API\CommentController',
        'users' => 'API\UserController',
        'tags' => 'API\TagController'

    ]);
});
