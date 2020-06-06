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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


// Route::apiResource('users', 'Api\UserController');
Route::get('users', 'Api\UserController@index')->name('users.index');
Route::post('users', 'Api\UserController@store')->name('users.store');
Route::get('users/{user}', 'Api\UserController@show')->name('users.show');
Route::put('users/{user}', 'Api\UserController@update')->name('users.update');
Route::delete('users/{user}', 'Api\UserController@destroy')->name('users.destroy');
