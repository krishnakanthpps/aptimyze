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

Route::get('/', 'PagesController@welcome');

Route::get('/about', 'PagesController@about');
Route::get('/terms', 'PagesController@terms');
Route::get('/privacy', 'PagesController@privacy');

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

Route::resource('/contact', 'ContactController');
Route::resource('/subscriptions', 'SubscriptionsController');

Route::get('/users/changepassword','UserController@getChangePassword');
Route::post('/users/changepassword','UserController@postChangePassword');
Route::get('/users/profile','UserController@profile');

Route::get('test/count', 'TestController@count');
Route::get('test/graph/{id}', 'TestController@graph');
Route::get('test/start/{id}', 'TestController@start');
Route::get('test/check/{id}', 'TestController@check');
Route::get('test/stop/{id}', 'TestController@stop');
Route::get('test/end/{id}', 'TestController@end');
Route::get('test/chart', 'TestController@chart');

Route::resource('/users', 'UserController');

Route::resource('test', 'TestController');

