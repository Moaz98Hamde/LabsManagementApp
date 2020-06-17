<?php

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

use App\Device;

Route::redirect('/', '/login');
Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
    Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);



    Route::resource('/lab', 'LabController');
    Route::get('lab/{lab}/program', 'LabController@getProgram')->name('getProgram');;
    Route::get('/device/{device}/issue', 'DevicesController@createIssue')->name("device.createIssue");
    Route::get('lab/QR/{lab}', 'LabController@labQR')->name('qrCode');

    Route::resource('lab.device', 'DevicesController');



    Route::resource('device.issue', 'IssuesController');
    Route::get('issue/{issue}/resolve', 'IssuesController@resolveIssue')->name("resolve");
    Route::get('issue/{issue}/retreat', 'IssuesController@retreatIssue')->name("retreat");

});




// Route::get('/tests', function () {
//     $pdf = App::make('dompdf.wrapper');
// 		$pdf->loadView('test');
// 		return $pdf->stream();
// });