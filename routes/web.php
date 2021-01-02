<?php

use Illuminate\Support\Facades\Route;

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
Route::group(['prefix' => 'api'], function () {
    Route::get('/rank/list', "OperatorsController@getRanks");
    Route::get('/employe/list', "OperatorsController@list");
    Route::post('/employe/add', "OperatorsController@store");
    Route::post('/employe/update', "OperatorsController@edit");
    Route::post('/employe/delete', "OperatorsController@delete");
});