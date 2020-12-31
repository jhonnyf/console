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

Route::group(['prefix' => 'login'], function () {
    Route::get('', 'loginController@index')->name('login.index');
    Route::post('authenticate', 'loginController@authenticate')->name('login.authenticate');
    Route::get('logout', 'LoginController@logout')->name('login.logout');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('', 'DashboardController@index')->name('dashboard');

    Route::group(['prefix' => 'user'], function () {

        Route::group(['prefix' => 'category'], function () {
            Route::get('{id}', 'UsersController@category')->name('users.category');
            Route::post('{id}', 'UsersController@categoryStore')->name('users.category-store');
        });

        Route::group(['prefix' => 'password'], function () {
            Route::get('{id}', 'UsersController@password')->name('users.password');
            Route::post('{id}', 'UsersController@passwordStore')->name('users.password-store');
        });

        Route::get('', 'UsersController@index')->name('users.index');
        Route::get('form/{id?}', 'UsersController@form')->name('users.form');
        Route::post('form', 'UsersController@store')->name('users.store');
        Route::put('form/{id}', 'UsersController@update')->name('users.update');
        Route::get('active/{id}', 'UsersController@active')->name('users.active');
        Route::get('destroy/{id}', 'UsersController@destroy')->name('users.destroy');
    });

    Route::group(['prefix' => 'category'], function () {
        Route::get('show/{id}', 'CategoriesController@show')->name('categories.show');
        Route::post('structure', 'CategoriesController@structure')->name('categories.structure');
        Route::get('form/{id?}', 'CategoriesController@form')->name('categories.form');
        Route::get('active/{id}', 'CategoriesController@active')->name('categories.active');
        Route::get('destroy/{id}', 'CategoriesController@destroy')->name('categories.destroy');
        Route::get('', 'CategoriesController@index')->name('categories.index');
        Route::post('', 'CategoriesController@store')->name('categories.store');
        Route::put('{id}', 'CategoriesController@update')->name('categories.update');

        Route::group(['prefix' => 'content'], function(){
            Route::get('{id}', 'CategoriesController@content')->name('categories.content');
            Route::post('{id}', 'CategoriesController@contentUpdate')->name('categories.content-update');
        });
    });

    Route::group(['prefix' => 'content'], function () {
        Route::get('form/{id?}', 'ContentsController@form')->name('contents.form');
        Route::get('active/{id}', 'ContentsController@active')->name('contents.active');
        Route::get('destroy/{id}', 'ContentsController@destroy')->name('contents.destroy');
        Route::get('', 'ContentsController@index')->name('contents.index');
        Route::post('', 'ContentsController@store')->name('contents.store');
        Route::put('{id}', 'ContentsController@update')->name('contents.update');
    });

    Route::group(['prefix' => 'file'], function () {

        Route::get('form/{id?}', 'FilesController@form')->name('files.form');
        Route::put('form/{id}', 'FilesController@update')->name('files.update');
        Route::get('active/{id}', 'FilesController@active')->name('files.active');
        Route::get('destroy/{id}', 'FilesController@destroy')->name('files.destroy');

        Route::get('{module}/{link_id}', 'FilesController@listGalleries')->name('files.listGalleries');

        Route::group(['prefix' => 'upload'], function () {
            Route::get('form/{module}/{link_id}/{file_gallery_id}', 'FilesController@uploadForm')->name('files.upload-form');
            Route::post('submit/{module}/{link_id}/{file_gallery_id}', 'FilesController@submitFiles')->name('files.upload-submit');
        });
    });

    Route::group(['prefix' => 'file-gallery'], function () {
        Route::get('', 'FilesGalleriesController@index')->name('filesGalleries.index');
        Route::get('form/{id?}', 'FilesGalleriesController@form')->name('filesGalleries.form');
        Route::post('form', 'FilesGalleriesController@store')->name('filesGalleries.store');
        Route::put('form/{id}', 'FilesGalleriesController@update')->name('filesGalleries.update');
        Route::get('active/{id}', 'FilesGalleriesController@active')->name('filesGalleries.active');
        Route::get('destroy/{id}', 'FilesGalleriesController@destroy')->name('filesGalleries.destroy');
    });

    Route::group(['prefix' => 'language'], function () {
        Route::get('', 'LanguagesController@index')->name('languages.index');
        Route::get('form/{id?}', 'LanguagesController@form')->name('languages.form');
        Route::post('form', 'LanguagesController@store')->name('languages.store');
        Route::put('form/{id}', 'LanguagesController@update')->name('languages.update');
        Route::get('active/{id}', 'LanguagesController@active')->name('languages.active');
        Route::get('destroy/{id}', 'LanguagesController@destroy')->name('languages.destroy');
    });

    Route::group(['prefix' => 'coin'], function () {
        Route::get('', 'CoinsController@index')->name('coins.index');
        Route::get('form/{id?}', 'CoinsController@form')->name('coins.form');
        Route::post('form', 'CoinsController@store')->name('coins.store');
        Route::put('form/{id}', 'CoinsController@update')->name('coins.update');
        Route::get('active/{id}', 'CoinsController@active')->name('coins.active');
        Route::get('destroy/{id}', 'CoinsController@destroy')->name('coins.destroy');
    });

    Route::group(['prefix' => 'product'], function () {
        Route::get('', 'ProductsController@index')->name('products.index');
        Route::get('form/{id?}', 'ProductsController@form')->name('products.form');
        Route::post('form', 'ProductsController@store')->name('products.store');
        Route::put('form/{id}', 'ProductsController@update')->name('products.update');
        Route::get('active/{id}', 'ProductsController@active')->name('products.active');
        Route::get('destroy/{id}', 'ProductsController@destroy')->name('products.destroy');

        Route::group(['prefix' => 'content'], function(){
            Route::get('{id}', 'ProductsController@content')->name('products.content');
            Route::post('{id}', 'ProductsController@contentUpdate')->name('products.content-update');
        });
    });
});
