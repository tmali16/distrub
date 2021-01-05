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

Route::get('/', 'HomeController@index')->name('home');


Route::get('/users', 'HomeController@users')->name('users');
Route::get('/users/edit/{id}', 'HomeController@userEdit')->name('user_edit');
Route::post('/users/pass/edit/', 'HomeController@userPassEdit')->name('user_pass_edit');
Route::post('/users/edit/{id}/store', 'HomeController@userEditStore')->name('user_edit_store');
Route::post('/users/delete/', 'HomeController@userDelete')->name('user_delete');


Route::get('/users/distrub', 'DistrubController@index')->name('distrub_index');

Route::get('/empleyee', 'OperatorsController@index')->name('empleyee');

Route::get('/directory', 'ServicesController@index')->name('directory');

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

    Route::post('/distrub/chart', "DistrubController@chart");
    Route::post('/distrub/chart/prison', "DistrubController@asPrison");
});
