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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware([])->group(function () {

    Route::get('albums', function () {
        return \App\Album::latest()->limit(25)->get()->toArray();
    });

    Route::get('artists', function () {
        return \App\Artist::latest()->limit(25)->get()->toArray();
    });

    Route::get('listens', 'Api\ListenController@index');
});
