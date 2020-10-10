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


// Route::middleware('role')->namespace('Posts')->group(function () {
//     Route::get('/post', 'PostController@index');
//     Route::post('/post', 'PostController@store');
// });
Route::group(['namespace' => 'Posts'], function () {
    Route::get('/post', 'PostController@index');
    Route::post('/post', 'PostController@store');
});

Route::post('/service', 'ServiceController@store');
