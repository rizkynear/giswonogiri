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

Auth::routes(['reset' => false]);


Route::group(['middleware' => 'anonymous'], function() {
	Route::get('/', 'HomeController@index')->name('home');

	Route::get('peta', 'PetaController@index')->name('home.peta');
	Route::post('peta/search', 'PetaController@search')->name('home.peta.search');
});