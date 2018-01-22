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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');
Route::post('/logout', 'Auth\LoginController@logout');

Route::get('/adminPanel','UsersController@adminPanel')->name('adminPanel');

Route::get('/dashboard', function(){
    return view('dashboard.index');
})->name('dashboard');

Route::group(['prefix' => 'users', 'middleware' => 'auth'], function () {
    Route::get('/', 'UsersController@index' )->name('users');
    Route::post('/{user}/makeAdmin', 'UsersController@makeAdmin');
    Route::post('/{user}/makeActive', 'UsersController@activateOrDeactivateUser');
    Route::get('/add', 'UsersController@create');
    Route::post('/add', 'UsersController@store');
});

Route::group(['prefix' => 'types', 'middleware' => 'auth'], function () {
    Route::get('/', 'TypesController@index')->name('types');
    Route::get('/add', 'TypesController@create');
    Route::post('/add', 'TypesController@store');
    Route::get('/{type}/edit', 'TypesController@edit');
    Route::put('/{type}/edit', 'TypesController@update');
    Route::delete('/{type}/delete', 'TypesController@destroy');
});

Route::group(['prefix' => 'vendors', 'middleware' => 'auth'], function () {
    Route::get('/', 'VendorsController@index')->name('vendors');
    Route::get('/{vendor}/edit', 'VendorsController@edit');
    Route::get('/add', 'VendorsController@create');
    Route::post('/add', 'VendorsController@store');
    Route::put('/{vendor}/edit', 'VendorsController@update');
    Route::delete('/{vendor}/delete', 'VendorsController@destroy');
});



Route::group(['prefix' => 'items', 'middleware' => 'auth'], function () {
    Route::get('/', 'ItemsController@index')->name('items');
    Route::get('/add', 'ItemsController@create');
    Route::post('/add', 'ItemsController@store');
    Route::get('/{item}/edit', 'ItemsController@edit');
    Route::put('/{item}/edit', 'ItemsController@update');
    Route::delete('/{item}/delete', 'ItemsController@destroy');

});

Route::post( '/search', 'SearchController@search');

