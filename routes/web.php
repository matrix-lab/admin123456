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

//https://secure.gravatar.com/avatar/{{ md5(auth()->user()->email) }}?size=512

Route::get('/login', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/team', [
    'uses' => 'HomeController@team',
    'as'   => 'devops.team',
]);
Route::get('/user', [
    'uses' => 'HomeController@user',
    'as'   => 'devops.user',
]);
Route::get('/customer', [
    'uses' => 'HomeController@customer',
    'as'   => 'devops.customer',
]);
Route::get('/task', [
    'uses' => 'HomeController@task',
    'as'   => 'devops.task',
]);
Route::get('/version', [
    'uses' => 'HomeController@version',
    'as'   => 'devops.version',
]);
Route::get('/motto', [
    'uses' => 'HomeController@motto',
    'as'   => 'devops.motto',
]);

Route::prefix('api')->namespace('API')->group(function () {
    Route::get('/team', 'TeamController@index');
    Route::post('/team', 'TeamController@store');
    Route::put('/team/{team}', 'TeamController@update');
    Route::delete('/team/{team}', 'TeamController@destroy');

    Route::get('/user', 'UserController@index');
    Route::post('/user', 'UserController@store');
    Route::put('/user/{user}', 'UserController@update');
    Route::delete('/user/{user}', 'UserController@destroy');

    Route::get('/customer', 'CustomerController@index');
    Route::post('/customer', 'CustomerController@store');
    Route::put('/customer/{customer}', 'CustomerController@update');
    Route::delete('/customer/{customer}', 'CustomerController@destroy');

    Route::get('/task', 'TaskController@index');
    Route::post('/task', 'TaskController@store');
    Route::put('/task/{task}', 'TaskController@update');
    Route::delete('/task/{task}', 'TaskController@destroy');

    Route::get('/version', 'VersionController@index');
    Route::post('/version', 'VersionController@store');
    Route::put('/version/{version}', 'VersionController@update');
    Route::put('/version-approve/{version}', 'VersionController@approve');
    Route::put('/version-finish/{version}', 'VersionController@finish');
    Route::delete('/version/{version}', 'VersionController@destroy');

    Route::get('/motto', 'MottoController@index');
    Route::post('/motto', 'MottoController@store');
    Route::put('/motto/{motto}', 'MottoController@update');
    Route::delete('/motto/{motto}', 'MottoController@destroy');
});
