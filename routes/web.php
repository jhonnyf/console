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

Route::group([], function () {
    Route::get('', 'DashboardController@index')->name('dashboard');

    Route::group(['prefix' => 'user'], function () {
        Route::get('form/{id?}', 'UsersController@form')->name('users.form');
        Route::get('active/{id}', 'UsersController@active')->name('users.active');
        Route::get('destroy/{id}', 'UsersController@destroy')->name('users.destroy');
        Route::get('', 'UsersController@index')->name('users.index');
        Route::post('', 'UsersController@store')->name('users.store');
        Route::put('{id}', 'UsersController@update')->name('users.update');
    });
    
    Route::group(['prefix' => 'user-type'], function () {
        Route::get('form/{id?}', 'UsersTypesController@form')->name('usersTypes.form');
        Route::get('active/{id}', 'UsersTypesController@active')->name('usersTypes.active');
        Route::get('destroy/{id}', 'UsersTypesController@destroy')->name('usersTypes.destroy');
        Route::get('', 'UsersTypesController@index')->name('usersTypes.index');
        Route::post('', 'UsersTypesController@store')->name('usersTypes.store');
        Route::put('{id}', 'UsersTypesController@update')->name('usersTypes.update');
    });
});
