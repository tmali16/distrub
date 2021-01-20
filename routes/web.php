<?php

use Illuminate\Support\Facades\Route;
use Laravel\Ui\AuthRouteMethods\AuthRouteMethods;
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

Auth::routes();

Route::get('/', function(){    
    return view('welcome');
})->middleware('guest');

Route::get("/a", "VideoRecorderController@Notify");

Route::get('/test', 'PermissionController@getClass');

Route::get('/api/prision/dvr/get', 'VideoRecorderController@getPrisions');
Route::get('/api/prision/dvr/info/{id}', 'VideoRecorderController@parsePrtg');

Route::group(['middleware' => ['auth', 'level:1']], function () {
    Route::get('/log', 'JournalController@index')->name('Journal');
});

Route::group(['middleware' => ['auth', 'level:3']], function () {
    Route::get('/index', 'HomeController@index')->name('home');
    
    Route::get('/users', 'HomeController@users')->name('users');
    Route::get('/users/edit/{id}', 'HomeController@userEdit')->name('user_edit');
    Route::post('/users/pass/edit/', 'HomeController@userPassEdit')->name('user_pass_edit');
    Route::post('/users/edit/{id}/store', 'HomeController@userEditStore')->name('user_edit_store');
    Route::post('/users/delete/', 'HomeController@userDelete')->name('user_delete');

    Route::get('/users/distrub', 'DistrubController@index')->name('distrub_index');
    Route::get('/empleyee', 'OperatorsController@index')->name('empleyee');
    Route::get('/directory', 'ServicesController@index')->name('directory');

    Route::get('/roles', 'PermissionController@index')->name('role');
    
    Route::get('/video', 'MediaController@index')->name('video');
    
});

Route::group(['prefix' => 'api', 'middleware' => 'auth'], function () {
    Route::get('/rank/list', "OperatorsController@getRanks");

    Route::get('/prison/list', "PrisionsController@list");
    Route::get('/prison/get', "PrisionsController@get");

    Route::get('/employe/all', "OperatorsController@all");
    Route::get('/employe/list', "OperatorsController@list");
    Route::post('/employe/add', "OperatorsController@store");
    Route::post('/employe/update', "OperatorsController@edit");
    Route::post('/employe/delete', "OperatorsController@delete");

    Route::post('/distrub/list', "DistrubController@list");
    Route::post('/distrub/add', "DistrubController@store");
    Route::get('/distrub/detail/{id}', "DistrubController@show");
    Route::post('/distrub/update', "DistrubController@edit");
    Route::post('/distrub/delete', "DistrubController@delete");


    Route::get('/directory/list', "ServicesController@response");

    Route::post('/directory/service/create', "ServicesController@create");
    Route::post('/directory/service/update', "ServicesController@update");
    Route::post('/directory/service/delete', "ServicesController@delete");

    Route::post('/directory/distrubType/create', "DistrubTypeController@create");
    Route::post('/directory/distrubType/update', "DistrubTypeController@update");
    Route::post('/directory/distrubType/delete', "DistrubTypeController@delete");

    Route::get('/directory/prison/all', "PrisionsController@all");
    Route::post('/directory/prison/create', "PrisionsController@create");
    Route::post('/directory/prison/update', "PrisionsController@update");
    Route::post('/directory/prison/delete', "PrisionsController@delete");
    
    Route::get('/directory/dvr/all', "VideoRecorderController@all");
    Route::post('/directory/dvr/create', "VideoRecorderController@create");
    Route::post('/directory/dvr/update', "VideoRecorderController@update");
    Route::post('/directory/dvr/delete', "VideoRecorderController@delete");

    Route::post('/distrub/chart', "DistrubController@chart");
    Route::post('/distrub/chart/prison', "DistrubController@asPrison");

    Route::group(['prefix' => 'users', 'middleware' => 'auth'], function () {
        Route::get('/role/list', "PermissionController@list");
        Route::post('/role/create', "PermissionController@create");
        Route::post('/role/update', "PermissionController@update");
        Route::post('/role/delete', "PermissionController@delete");
    });
});
