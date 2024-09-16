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

Route::prefix('roles')->group(function() {
    Route::get('/{role?}', 'RolesController@index')->name('roles.index');
    Route::post('permissions/{role?}', 'RolesController@updatePermission')->name('permissions.update');
    Route::post('/', 'RolesController@store')->name('roles.store');
    Route::put('/', 'RolesController@update')->name('roles.update');
    Route::delete('/', 'RolesController@destroy')->name('roles.destroy');
});
