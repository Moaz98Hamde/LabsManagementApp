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



Route::get('labs', 'ApiController@allLabs')->name('api.labs');
Route::get('labs/{lab}/devices/', 'ApiController@allLabDevices')->name('api.devices');
Route::get('labs/{lab}/devices/{device}', 'ApiController@device')->name('api.device');
Route::get('labs/{lab}/devices/{device}/issues', 'ApiController@deviceIssues')->name('api.device.issues');
Route::post('labs/{lab}/devices/{device}/issues', 'ApiController@newIssue')->name('api.device.issue.store');