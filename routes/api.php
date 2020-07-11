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

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/tweets', 'Api\TweetsController@index');

    Route::get('/tweets/{tweet}/replies', 'Api\RepliesController@index');
    Route::post('/tweets','Api\TweetsController@store');

    Route::get('replies/{reply}/children/json', 'Api\RepliesController@jsonShow');

    Route::get('/profile/avatar', 'Api\UserAvatarController@show');
    Route::get('/profile', 'Api\ProfilesController@index');
    Route::get('/profiles/{user}', 'Api\ProfilesController@show');
    Route::get('/profiles/{user}/tweets', 'Api\ProfileTweetsController@show');
});

Route::post('/register', 'Api\AuthController@register');
Route::post('/login', 'Api\AuthController@login');
Route::post('/logout', 'Api\AuthController@logout');
