<?php

/*
|--------------------------------------------------------------------------
| Super Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['namespace' => 'SuperAdmin', 'middleware' => ['auth', 'super.admin']], function(){
	Route::get('/', function(){
		return redirect('super-admin/dashboard');
	});

	Route::get('dashboard', 'DashboardController@indexDashboard');

	Route::group(['prefix' => 'admin'], function() {
		Route::get('tambah-admin', 'AdminController@tambahAdmin');
		Route::post('tambah-admin', '\App\Http\Controllers\Auth\RegisterController@register');
		Route::get('data-admin', 'AdminController@dataAdmin');
		Route::delete('data-admin/{id}', 'AdminController@deleteAdmin');
		Route::put('data-admin/{id}', 'AdminController@restoreAdmin');
		// Route::get('{id}/edit-admin', 'adminController@editadmin');
		// Route::put('{id}/edit-admin', 'adminController@updateadmin');
	});
});