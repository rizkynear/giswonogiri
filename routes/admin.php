<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['namespace' => 'Admin', 'middleware' => ['auth', 'admin']], function(){
	Route::get('/', function(){
		return redirect('admin/dashboard');
	});

	Route::get('dashboard', 'DashboardController@indexDashboard');

	Route::group(['prefix' => 'kategori'], function() {
		Route::get('tambah-kategori', 'KategoriController@tambahKategori');
		Route::post('tambah-kategori', 'KategoriController@simpanKategori');
		Route::get('data-kategori', 'KategoriController@dataKategori');
		Route::delete('data-kategori/{id}', 'KategoriController@deleteKategori');
		Route::get('{id}/edit-kategori', 'KategoriController@editKategori');
		Route::put('{id}/edit-kategori', 'KategoriController@updateKategori');
	});

	Route::group(['prefix' => 'peta'], function() {
		Route::get('peta', 'PetaController@lihatPeta')->name('peta.index');
		Route::get('peta/kategori/{id}', 'PetaController@kategoriWisata');
		Route::get('peta/search', 'PetaController@search');
	});

	Route::group(['prefix' => 'user'], function() {
		Route::get('data-user', 'UserController@dataUser');
		Route::put('data-user/{id}/edit-user', 'UserController@updateUser');
	});
	
	Route::group(['prefix' => 'wisata'], function() {
		Route::get('tambah-wisata', 'WisataController@tambahWisata');
		Route::post('tambah-wisata', 'WisataController@simpanWisata');
		Route::get('data-wisata', 'WisataController@dataWisata');
		Route::delete('data-wisata/{id}', 'WisataController@deleteWisata');
		Route::get('{id}/edit-wisata', 'WisataController@editWisata');
		Route::put('{id}/edit-wisata', 'WisataController@updateWisata');
	});
});