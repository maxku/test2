<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::controller('employee', 'EmployeeController');
Route::get('/employee', [
    'middleware' => ['auth'],
    'uses'       => 'EmployeeController@getIndex',
]);
Route::get('/find', 'PagesController@find');
Route::get('/', 'PagesController@index');

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
});

Route::auth();

Route::get('/home', 'PagesController@index');

