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



Route::get('labs', 'ApiController@allLabs');
Route::get('labs/{lab}/devices/', 'ApiController@allLabDevices');
Route::get('labs/{lab}/devices/{device}', 'ApiController@device');
Route::get('labs/{lab}/devices/{device}/issues', 'ApiController@deviceIssues');
Route::post('labs/{lab}/devices/{device}/issues', 'ApiController@newIssue');
