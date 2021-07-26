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

Route::post('person', '\App\Http\Controllers\PersonController@create');
Route::get('person', '\App\Http\Controllers\PersonController@all');
Route::get('person/{id}', '\App\Http\Controllers\PersonController@find');
Route::put('person/{id}', '\App\Http\Controllers\PersonController@update');
Route::delete('person/{id}', '\App\Http\Controllers\PersonController@delete');

Route::post('person/{personId}/apps', '\App\Http\Controllers\PersonAppController@create');
Route::delete('person/{personId}/apps/{id}', '\App\Http\Controllers\PersonAppController@delete');
Route::get('person/{personId}/apps', '\App\Http\Controllers\PersonAppController@all');

Route::post('apps', '\App\Http\Controllers\AppController@create');
Route::get('apps', '\App\Http\Controllers\AppController@all');
Route::put('apps/{appsid}', '\App\Http\Controllers\AppController@update');
Route::delete('apps/{appsid}', '\App\Http\Controllers\AppController@delete');
Route::get('apps/{appsid}', '\App\Http\Controllers\AppController@find');

