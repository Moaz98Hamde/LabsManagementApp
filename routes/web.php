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
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
    Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);



    Route::resource('/lab', 'LabController');
    Route::get('lab/{lab}/program', 'LabController@getProgram')->name('getProgram');;
    Route::get('/device/{device}/issue', 'DevicesController@createIssue')->name("device.createIssue");

    Route::resource('lab.device', 'DevicesController');


    Route::resource('device.issue', 'IssuesController');
    Route::get('issue/{issue}/resolve', 'IssuesController@resolveIssue')->name("resolve");
    Route::get('issue/{issue}/retreat', 'IssuesController@retreatIssue')->name("retreat");


    Route::get('qr/{id}', function($id){
        $lab = App\Lab::findOrFail($id);
        $code = QrCode::size(300)->generate(Route('getData', $id));
        return view('labs.qrCode', ['code' =>$code, 'name' => $lab->name]);
    })->name('qrCode');
});





Route::get('/data/{id}', function($id){
    return 'data of '.$id;
})->name('getData');





Route::get('/tests', function () {
    $pdf = App::make('dompdf.wrapper');
		$pdf->loadView('test');
		return $pdf->stream();
});





Route::get('/test', function(){
 $lab = App\Lab::find(12);
 $file = Storage::get($lab->program);
 return view('test', ['file' => $file]);
});