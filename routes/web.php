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
        Route::group(['prefix' => 'category'], function () {
            Route::get('{id}', 'UsersController@category')->name('users.category');
            Route::post('{id}', 'UsersController@categoryStore')->name('users.category-store');
        });

        Route::get('form/{id?}', 'UsersController@form')->name('users.form');
        Route::get('active/{id}', 'UsersController@active')->name('users.active');
        Route::get('destroy/{id}', 'UsersController@destroy')->name('users.destroy');
        Route::get('', 'UsersController@index')->name('users.index');
        Route::post('', 'UsersController@store')->name('users.store');
        Route::put('{id}', 'UsersController@update')->name('users.update');
    });

    Route::group(['prefix' => 'category'], function () {
        Route::post('structure', 'CategoriesController@structure')->name('categories.structure');
        Route::get('form/{id?}', 'CategoriesController@form')->name('categories.form');
        Route::get('active/{id}', 'CategoriesController@active')->name('categories.active');
        Route::get('destroy/{id}', 'CategoriesController@destroy')->name('categories.destroy');
        Route::get('', 'CategoriesController@index')->name('categories.index');
        Route::post('', 'CategoriesController@store')->name('categories.store');
        Route::put('{id}', 'CategoriesController@update')->name('categories.update');
    });

    Route::group(['prefix' => 'content'], function () {        
        Route::get('form/{id?}', 'ContentsController@form')->name('contents.form');
        Route::get('active/{id}', 'ContentsController@active')->name('contents.active');
        Route::get('destroy/{id}', 'ContentsController@destroy')->name('contents.destroy');
        Route::get('', 'ContentsController@index')->name('contents.index');
        Route::post('', 'ContentsController@store')->name('contents.store');
        Route::put('{id}', 'ContentsController@update')->name('contents.update');
    });
});
