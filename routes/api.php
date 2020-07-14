<?php

use Illuminate\Http\Request;

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


Route::post('login', 'LoginController@login') -> name('login');
Route::post('register', 'RegisterController@register');
Route::get('register/activate/{token}', 'RegisterController@signupActivate');
Route::get('details', 'DetailsController@getname');


Route::middleware('auth:api')->group(
    function () {
    Route::get('details', 'DetailsController@details'); //information of the logged in user
    Route::get('logout', 'LoginController@logout') -> name('logout');
});

//everything regarding password reset
Route::group([
    'namespace' => 'Auth',
    'middleware' => 'api',
    'prefix' => 'password' // http://demoapi.test/api/password
], function () {
    Route::post('create', 'PasswordResetController@create'); //token creation
    Route::get('find/{token}', 'PasswordResetController@find'); // find info of the user who requested a password reset
    Route::post('reset', 'PasswordResetController@reset'); //resets with the new password
});

 //list posts
Route::get('posts', 'PostController@index');

//show single post
Route::get('post/{id}', 'PostController@show');

//create new post
Route::post('post', 'PostController@store');

//edit a post
Route::put('post', 'PostController@store');

//delete a post
Route::delete('post/{id}', 'PostController@destroy');

