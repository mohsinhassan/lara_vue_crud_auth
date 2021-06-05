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

// Route::get('{any}', function () {
//     return view('app');
// })->where('any', '.*');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('books', 'App\Http\Controllers\BookController@index');
// Route::group(['prefix' => 'book'], function () {
//     Route::post('add', 'App\Http\Controllers\BookController@add');
//     Route::get('edit/{id}', 'App\Http\Controllers\BookController@edit');
//     Route::post('update/{id}', 'App\Http\Controllers\BookController@update');
//     Route::delete('delete/{id}', 'App\Http\Controllers\BookController@delete');
// });

/*Route::prefix('book')->group(function () {
    Route::get('{any}', function () {
        return view('app');
    })->where('any', '.*');
});
*/



//Route::get('/book', [App\Http\Controllers\BookController::class, 'index'])->name('book');
// Route::get('/home', function () {
//          return view('app');
//     })->name('home');


// Route::any('/', function () {
//     return view('app');
// });
