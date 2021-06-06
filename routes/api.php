<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
#use App\Http\Controllers\BookController;

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


Route::get('developers', 'App\Http\Controllers\DeveloperController@index');
Route::group(['prefix' => 'developer'], function () {
    Route::post('add', 'App\Http\Controllers\DeveloperController@add');
    Route::get('edit/{id}', 'App\Http\Controllers\DeveloperController@edit');
    Route::post('update/{id}', 'App\Http\Controllers\DeveloperController@update');
    Route::delete('delete/{id}', 'App\Http\Controllers\DeveloperController@delete');
});
